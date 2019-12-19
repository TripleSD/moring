<?php

namespace App\Http\Controllers\Admin\Network;

use App\Http\Controllers\Controller;
use App\Models\Devices;
use App\Models\DevicesFirmwares;
use App\Models\DevicesModels;
use App\Models\DevicesVendors;
use App\Repositories\Devices\DevicesRepository;
use App\Repositories\Snmp\SnmpRepository;
use Illuminate\Http\Request;

class NetworkDevicesController extends Controller
{
    private $snmpRepository;
    private $deviceRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
        $this->deviceRepository = new DevicesRepository();
    }

    public function index()
    {
        $devices = Devices::with('firmware', 'model')->get();

        return view('admin.network.devices.index', compact('devices'));
    }

    public function create()
    {
        return view('admin.network.devices.create');
    }

    public function store(Request $request)
    {
        try {
            // Getting vars from template
            $hostname = $request->input('hostname');
            $community = $request->input('community');
            $port = $request->input('snmp_port');
            $snmpVersion = $request->input('snmp_version');

            $snmpFlow = $this->snmpRepository->getSnmpFlow($hostname, $community);
            $vendor = $this->snmpRepository->getVendor($snmpFlow);
            $c = '\App\Repositories\Snmp\Vendors\\' . $vendor;
            $firmwareClass = new $c();

            // Gettings vars from device
            $location = $firmwareClass->getLocation($snmpFlow);
            $contact = $firmwareClass->getContact($snmpFlow);
            $model = $firmwareClass->getModel($snmpFlow);
            $firmwareTitle = $firmwareClass->getFirmware($snmpFlow);
            $firmwareVersion = $firmwareClass->getFirmwareVersion($snmpFlow);
            $uptimeDevice = $firmwareClass->getUptime($snmpFlow);
            $packetsVersion = $firmwareClass->getPacketsVersion($snmpFlow);
            $serialNumber = $firmwareClass->getSerialnNumber($snmpFlow);
            $humanModel = $firmwareClass->getHumanModel($snmpFlow);
            $licenseLevel = $firmwareClass->getLicenseLevel($snmpFlow);

            $firmware = $this->checkFirmware($firmwareTitle, $firmwareVersion);
            $vendorId = $this->checkVendor($vendor);
            $modelId = $this->checkModel($model);
            $this->deviceRepository->saveDevice(
                $hostname,
                $vendorId,
                $modelId,
                $firmware,
                $uptimeDevice,
                $contact,
                $location,
                $humanModel,
                $licenseLevel,
                $serialNumber,
                $packetsVersion
            );
            flash('Хост добавлен')->success();

            return redirect()->route('network.devices.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            flash('Не удалось получить SNMP данные')->warning();

            return redirect()->back()->withInput();
        }
    }

    public function checkVendor($vendorTitle)
    {
        $vendor = DevicesVendors::where('title', $vendorTitle)->first();
        if (empty($vendor)) {
            $vendor = new DevicesVendors();
            $vendor->title = $vendorTitle;
            $vendor->save();

            return $vendor->id;
        } else {
            return $vendor->id;
        }
    }

    public function checkModel($modelTitle)
    {
        $model = DevicesModels::where('title', $modelTitle)->first();

        if (empty($model)) {
            $model = new DevicesModels();
            $model->title = $modelTitle;
            $model->save();

            return $model->id;
        } else {
            return $model->id;
        }
    }

    public function checkFirmware($firmwareTitle, $firmwareVersion)
    {
        $firmware = DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();

        if (empty($firmware)) {
            $firmware = new DevicesFirmwares();
            $firmware->title = $firmwareTitle;
            $firmware->version = $firmwareVersion;
            $firmware->save();

            return $firmware->id;
        } else {
            return $firmware->id;
        }
    }
}
