<?php

namespace App\Repositories\Devices;

use App\Models\DevicesFirmwares;
use App\Repositories\Repository;

class DevicesFirmwaresRepository extends Repository
{
    /**
     * @param string $firmwareTitle
     * @param string $firmwareVersion
     * @return int
     */
    public function checkFirmware(string $firmwareTitle, string $firmwareVersion = null): int
    {
        $firmware = DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();

        if (empty($firmware)) {
            $firmware          = new DevicesFirmwares();
            $firmware->title   = $firmwareTitle;
            $firmware->version = $firmwareVersion;
            $firmware->save();
        }

        return $firmware->id;
    }
}
