<?php

namespace App\Repositories\Devices;

use App\Models\Devices;
use App\Repositories\Repository;
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
            return Devices::with('firmware', 'model', 'vendor')->get();
        } elseif ($request->view == '10') {
            return Devices::with('firmware', 'model', 'vendor')->paginate(10);
        } elseif ($request->view == '25') {
            return Devices::with('firmware', 'model', 'vendor')->paginate(25);
        } elseif ($request->view == '50') {
            return Devices::with('firmware', 'model', 'vendor')->paginate(50);
        } else {
            return Devices::with('firmware', 'model', 'vendor')->paginate(10);
        }
    }

    /**
     * @param $deviceId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function editDevice($deviceId)
    {
        return Devices::with('model', 'vendor', 'firmware')->find($deviceId);
    }

    /**
     * @param $deviceId
     * @throws Exception
     */
    public function destroyDevice($deviceId): void
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

        $vendor = self::getVendor($snmpFlow);

        if ($vendor == null) {
            throw new Exception('Не удалось определить производителя.');
        } else {
            $firmwareClassFile = '\App\Repositories\Snmp\Vendors\\' . $vendor;
            $firmwareClass     = new $firmwareClassFile();

            //Set vars
            $deviceData['hostname']      = $deviceDataConnection['hostname'];
            $deviceData['title']         = $deviceDataConnection['title'];
            $deviceData['snmpCommunity'] = $deviceDataConnection['snmpCommunity'];
            $deviceData['snmpPort']      = $deviceDataConnection['snmpPort'];
            $deviceData['snmpVersion']   = $deviceDataConnection['snmpVersion'];

            // Get & set vars from device
            $deviceData['location']        = $firmwareClass->getLocation($snmpFlow);
            $deviceData['contact']         = $firmwareClass->getContact($snmpFlow);
            $deviceData['model']           = $firmwareClass->getModel($snmpFlow);
            $deviceData['platformType']    = $firmwareClass->getPlatformType($deviceData['model']);
            $deviceData['firmwareTitle']   = $firmwareClass->getFirmware($snmpFlow);
            $deviceData['firmwareVersion'] = $firmwareClass->getFirmwareVersion($snmpFlow);
            $deviceData['uptimeDevice']    = $firmwareClass->getUptime($snmpFlow);
            $deviceData['packetsVersion']  = $firmwareClass->getPacketsVersion($snmpFlow);
            $deviceData['serialNumber']    = $firmwareClass->getSerialNumber($snmpFlow);
            $deviceData['humanModel']      = $firmwareClass->getHumanModel($snmpFlow);
            $deviceData['licenseLevel']    = $firmwareClass->getLicenseLevel($snmpFlow);

            $deviceData['firmwareId'] = $this->devicesFirmwareRepository->checkFirmware(
                $deviceData['firmwareTitle'],
                $deviceData['firmwareVersion']
            );
            $deviceData['vendorId']   = $this->devicesVendorsRepository->checkVendor($vendor);
            $deviceData['modelId']    = $this->devicesModelsRepository->checkModel($deviceData['model']);

            return $deviceData;
        }
    }

    /**
     * @param array $deviceData
     * @param null $deviceId
     */
    public function storeDevice(array $deviceData, $deviceId = null): void
    {
        if ($deviceId === null) {
            $device = new Devices();
        } else {
            $device = Devices::find($deviceId);
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
    public function updateDevice($deviceData, $deviceId): void
    {
        self::storeDevice($deviceData, $deviceId);
    }

    /**
     * @param $snmpFlow
     * @return string|string[]
     * @throws Exception
     */
    public function getVendor($snmpFlow)
    {
        $vendor = $this->snmpRepository->getVendor($snmpFlow);

        return str_replace('-', '', $vendor); // Replace unused symbols
    }
}
