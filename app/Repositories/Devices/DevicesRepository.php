<?php

namespace App\Repositories\Devices;

use App\Models\Devices;
use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendor;
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
        $deviceData['hostname']    = $request->input('hostname');               // Hostname device
        $deviceData['title']       = $request->input('title');                  // Short description
        $deviceData['community']   = $request->input('snmp_community');         // Device community
        $deviceData['port']        = $request->input('snmp_port');              // Device snmp port
        $deviceData['snmpVersion'] = $request->input('snmp_version');           // Device snmp version 1/2/3

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
        $deviceData['hostname']    = $varsConnection['hostname'];
        $deviceData['title']       = $varsConnection['title'];
        $deviceData['community']   = $varsConnection['community'];
        $deviceData['port']        = $varsConnection['port'];
        $deviceData['snmpVersion'] = $varsConnection['snmpVersion'];

        // Get & set vars from device
        $deviceData['location']        = $device->getLocation($snmpFlow);
        $deviceData['contact']         = $device->getContact($snmpFlow);
        $deviceData['model']           = $device->getModel($snmpFlow);
        $deviceData['platformType']    = $device->getPlatformType($deviceData['model']);
        $deviceData['firmwareTitle']   = $device->getFirmware($snmpFlow);
        $deviceData['firmwareVersion'] = $device->getFirmwareVersion($snmpFlow);
        $deviceData['uptimeDevice']    = $device->getUptime($snmpFlow);
        $deviceData['packetsVersion']  = $device->getPacketsVersion($snmpFlow);
        $deviceData['serialNumber']    = $device->getSerialNumber($snmpFlow);
        $deviceData['licenseLevel']    = $device->getLicenseLevel($snmpFlow);

        $deviceData['firmwareId'] = $this->devicesFirmwareRepository->getFirmwareId(
            $deviceData['firmwareTitle'],
            $deviceData['firmwareVersion']
        );
        $deviceData['vendorId']   = $this->devicesVendorsRepository->getVendorId($vendorName);
        $deviceData['modelId']    = $this->devicesModelsRepository->getModelId($deviceData['model']);

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
        $device->vendor_id       = $deviceData['vendorId'];
        $device->model_id        = $deviceData['modelId'];
        $device->firmware_id     = $deviceData['firmwareId'];
        $device->uptime          = $deviceData['uptimeDevice'];
        $device->contact         = $deviceData['contact'];
        $device->location        = $deviceData['location'];
        $device->license_level   = $deviceData['licenseLevel'];
        $device->serial_number   = $deviceData['serialNumber'];
        $device->packets_version = $deviceData['packetsVersion'];
        $device->platform_type   = $deviceData['platformType'];
        $device->snmp_port       = $deviceData['port'];
        $device->snmp_community  = $deviceData['community'];
        $device->snmp_version    = $deviceData['snmpVersion'];
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
