<?php

namespace App\Repositories\Devices;

use App\Models\DevicesLogs;
use App\Repositories\Repository;

class DevicesLogsRepository extends Repository
{
    public function getLogsByDeviceId($deviceId)
    {
        return DevicesLogs::where('device_id', $deviceId)
            ->orderBy('id', 'desc')
            ->limit('6')
            ->get();
    }

    /**
     * @param int $deviceId
     * @param string $message
     * @param int $type
     */
    public function store(int $deviceId, string $message, int $type) : void
    {
        $log            = new DevicesLogs();
        $log->device_id = $deviceId;
        $log->message   = $message;
        $log->type      = $type;
        $log->resolved  = 0;
        $log->save();
    }
}
