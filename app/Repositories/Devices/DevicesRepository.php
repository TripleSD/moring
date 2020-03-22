<?php

namespace App\Repositories\Devices;

use App\Models\Devices;
use App\Repositories\Repository;
use App\Repositories\Snmp\ParseVendor;
use App\Repositories\Snmp\SnmpRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DevicesRepository extends Repository
{
    /** @var SnmpRepository */
    private $snmpRepository;
    private $devicesFirmwareRepository;
    private $devicesVendorsRepository;
    private $devicesModelsRepository;

    public function __construct()
    {
        $this->snmpRepository            = new SnmpRepository();
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
        $deviceData['hostname']      = $request->input('hostname');               // Hostname device
        $deviceData['title']         = $request->input('title');                  // Short description
        $deviceData['snmpCommunity'] = $request->input('snmp_community');         // Device community
        $deviceData['snmpPort']      = $request->input('snmp_port');              // Device snmp port
        $deviceData['snmpVersion']   = $request->input('snmp_version');           // Device snmp version 1/2/3

        return (array) $deviceData;
    }

    /**
     * @param array $deviceDataConnection
     * @return array
     * @throws Exception
     */
    public function getDeviceData(array $deviceDataConnection): array
    {
        // Get snmp flow
        $snmpFlow = $this->snmpRepository->getSnmpFlow(
            $deviceDataConnection['hostname'],
            $deviceDataConnection['snmpCommunity']
        );

        $vendorName = $this->getVendorName($snmpFlow);

        if ($vendorName == null) {
            throw new Exception('Не удалось определить производителя.');
        }

        $device = $this->getVendorClass($vendorName);

        //Set vars
        $deviceData['hostname']      = $deviceDataConnection['hostname'];
        $deviceData['title']         = $deviceDataConnection['title'];
        $deviceData['snmpCommunity'] = $deviceDataConnection['snmpCommunity'];
        $deviceData['snmpPort']      = $deviceDataConnection['snmpPort'];
        $deviceData['snmpVersion']   = $deviceDataConnection['snmpVersion'];

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
        $deviceData['humanModel']      = $device->getHumanModel($snmpFlow);
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
        $device->human_model     = $deviceData['humanModel'];
        $device->license_level   = $deviceData['licenseLevel'];
        $device->serial_number   = $deviceData['serialNumber'];
        $device->packets_version = $deviceData['packetsVersion'];
        $device->platform_type   = $deviceData['platformType'];
        $device->snmp_port       = $deviceData['snmpPort'];
        $device->snmp_community  = $deviceData['snmpCommunity'];
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

    /**
     * @param $snmpFlow
     * @return string|string[]
     * @throws Exception
     */
    private function getVendorName($snmpFlow)
    {
        $vendor = new ParseVendor();

        return $vendor->getName($snmpFlow);
    }

    private function getVendorClass($vendorName)
    {
        $class = 'App\Repositories\Snmp\Vendors\\' . $vendorName;

        return new $class();
    }
}
