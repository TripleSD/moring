<?php

namespace App\Repositories\Devices;

use App\Models\DevicesLogs;
use App\Repositories\Repository;

class DevicesLogsRepository extends Repository
{
    public function getLogsByDeviceId($deviceId)
    {
        return DevicesLogs::where('device_id', $deviceId)->get();
    }
}
