<?php

namespace App\Repositories\Devices;

use App\Models\Devices;
use App\Repositories\Repository;

class DevicesRepository extends Repository
{
    public function saveDevice(
        $hostname,
        $vendorId,
        $modelId,
        $firmwareId,
        $uptimeDevice,
        $contact,
        $location,
        $humanModel,
        $licenseLevel,
        $serialNumber,
        $packetsVersion
    ) {
        $device = new Devices();
        $device->hostname = $hostname;
        $device->vendor_id = $vendorId;
        $device->model_id = $modelId;
        $device->firmware_id = $firmwareId;
        $device->uptime = $uptimeDevice;
        $device->contact = $contact;
        $device->location = $location;
        $device->human_model = $humanModel;
        $device->license_level = $licenseLevel;
        $device->serial_number = $serialNumber;
        $device->packets_version = $packetsVersion;
        $device->save();

        return true;
    }
}
