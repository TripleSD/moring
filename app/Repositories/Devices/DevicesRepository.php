<?php

namespace App\Repositories\Devices;

use App\Models\Devices;
use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Vendor;
use App\Repositories\Snmp\VendorInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DevicesRepository extends Repository
{
    /** @var SnmpRepository */
    private $devicesFirmwareRepository;
    private $devicesVendorsRepository;
    private $devicesModelsRepository;

    public function __construct()
    {
        $this->devicesFirmwareRepository = new DevicesFirmwaresRepository();
        $this->devicesVendorsRepository  = new DevicesVendorsRepository();
        $this->devicesModelsRepository   = new DevicesModelsRepository();
    }

    /**
     * @param $request
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getDevicesList($request)
    {
        if ($request->view == 'all') {
            return Devices::with('firmware', 'model', 'vendor')
                ->with(
                    [
                        'logs' => function ($q) {
                            return $q->where('resolved', 0);
                        },
                    ]
                )
                ->get();
        } elseif ($request->view == '10') {
            return Devices::with('firmware', 'model', 'vendor')
                ->with(
                    [
                        'logs' => function ($q) {
                            return $q->where('resolved', 0);
                        },
                    ]
                )
                ->paginate(10);
        } elseif ($request->view == '25') {
            return Devices::with('firmware', 'model', 'vendor')
                ->with(
                    [
                        'logs' => function ($q) {
                            return $q->where('resolved', 0);
                        },
                    ]
                )
                ->paginate(25);
        } elseif ($request->view == '50') {
            return Devices::with('firmware', 'model', 'vendor')
                ->with(
                    [
                        'logs' => function ($q) {
                            return $q->where('resolved', 0);
                        },
                    ]
                )
                ->paginate(50);
        }

        return Devices::with('firmware', 'model', 'vendor')
            ->with(
                [
                    'logs' => function ($q) {
                        return $q->where('resolved', 0);
                    },
                ]
            )
            ->paginate(10);
    }

    /**
     * @param $deviceId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function edit($deviceId)
    {
        return Devices::with('model', 'vendor', 'firmware')->find($deviceId);
    }

    /**
     * @param $deviceId
     * @throws Exception
     */
    public function destroy($deviceId): void
    {
        $device = Devices::with('vendor', 'model')->find($deviceId);
        $device->delete();
    }

    /**
     * @param $deviceId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show($deviceId)
    {
        return Devices::with('model', 'vendor', 'firmware')->find($deviceId);
    }

    /**
     * @param $request
     * @return array
     */
    public function setDataConnection($request): array
    {
        $deviceData = [];

        // Getting vars from template
        $deviceData['hostname']     = $request->input('hostname');               // Hostname device
        $deviceData['title']        = $request->input('title');                  // Short description
        $deviceData['community']    = $request->input('snmp_community');         // Device community
        $deviceData['port']         = $request->input('snmp_port');              // Device snmp port
        $deviceData['snmp_version'] = $request->input('snmp_version');           // Device snmp version 1/2/3
        $deviceData['port_ssh']     = $request('port_ssh');
        $deviceData['port_telnet']  = $request('port_telnet');
        $deviceData['web_url']      = $request('web_url');

        return (array) $deviceData;
    }

    /**
     * @param array $varsConnection
     * @return array
     * @throws Exception
     */
    public function getDeviceData(array $varsConnection): array
    {
        try {
            $snmpObject          = new SnmpRepository();
            $snmpFlow            = $snmpObject->startSession($varsConnection);
            $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);
        } catch (Exception $e) {
            throw new Exception('Устройство не отвечает');
        }

        $vendor     = new Vendor();
        $vendorName = $vendor->parseName($vendorNameRawString);

        if ($vendorName == null) {
            throw new Exception('Не удалось определить производителя.');
        }

        /** @var VendorInterface $device */
        $device = $vendor->getVendorClass($vendorName);

        //Set vars
        $deviceData['hostname']       = $varsConnection['hostname'];
        $deviceData['title']          = $varsConnection['title'];
        $deviceData['snmp_community'] = $varsConnection['snmp_community'];
        $deviceData['snmp_port']      = $varsConnection['snmp_port'];
        $deviceData['snmp_version']   = $varsConnection['snmp_version'];

        // Get & set vars from device
        $deviceData['location']         = $device->getLocation($snmpFlow);
        $deviceData['contact']          = $device->getContact($snmpFlow);
        $deviceData['model']            = $device->getModel($snmpFlow);
        $deviceData['platform_type']    = $device->getPlatformType($deviceData['model']);
        $deviceData['firmware_title']   = $device->getFirmware($snmpFlow);
        $deviceData['firmware_version'] = $device->getFirmwareVersion($snmpFlow);
        $deviceData['uptime']           = $device->getUptime($snmpFlow);
        $deviceData['packets_version']  = $device->getPacketsVersion($snmpFlow);
        $deviceData['serial_number']    = $device->getSerialNumber($snmpFlow);
        $deviceData['license_level']    = $device->getLicenseLevel($snmpFlow);

        $deviceData['firmware_id'] = $this->devicesFirmwareRepository->getFirmwareId(
            $deviceData['firmware_title'],
            $deviceData['firmware_version']
        );
        $deviceData['vendor_id']   = $this->devicesVendorsRepository->getVendorId($vendorName);
        $deviceData['model_id']    = $this->devicesModelsRepository->getModelId($deviceData['model']);

        return $deviceData;
    }

    /**
     * @param array $deviceData
     * @param null $deviceId
     */
    public function store(array $deviceData, $deviceId = null): void
    {
        $device = Devices::find($deviceId);

        if ($deviceId === null) {
            $device = new Devices();
        }

        $device->title           = $deviceData['title'];
        $device->hostname        = $deviceData['hostname'];
        $device->vendor_id       = $deviceData['vendor_id'];
        $device->model_id        = $deviceData['model_id'];
        $device->firmware_id     = $deviceData['firmware_id'];
        $device->uptime          = $deviceData['uptime'];
        $device->enabled         = $deviceData['enabled'];
        $device->contact         = $deviceData['contact'];
        $device->location        = $deviceData['location'];
        $device->license_level   = $deviceData['license_level'];
        $device->serial_number   = $deviceData['serial_number'];
        $device->packets_version = $deviceData['packets_version'];
        $device->platform_type   = $deviceData['platform_type'];
        $device->snmp_port       = $deviceData['snmp_port'];
        $device->snmp_community  = $deviceData['snmp_community'];
        $device->snmp_version    = $deviceData['snmp_version'];
        $device->port_ssh        = $deviceData['port_ssh'];
        $device->port_telnet     = $deviceData['port_telnet'];
        $device->web_url         = $deviceData['web_url'];
        $device->save();
    }

    /**
     * @param $deviceData
     * @param $deviceId
     */
    public function update($deviceData, $deviceId): void
    {
        self::store($deviceData, $deviceId);
    }
}
