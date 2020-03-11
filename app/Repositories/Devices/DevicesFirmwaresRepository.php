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
        $firmware = $this->getFirmware($firmwareTitle, $firmwareVersion);

        if (empty($firmware)) {
            $firmware = $this->setFirmware($firmwareTitle, $firmwareVersion);
        }

        return $firmware->id;
    }

    public function getFirmware(string $firmwareTitle, string $firmwareVersion = null)
    {
        return DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();
    }

    public function setFirmware(string $firmwareTitle, string $firmwareVersion = null)
    {
        $firmware          = new DevicesFirmwares();
        $firmware->title   = $firmwareTitle;
        $firmware->version = $firmwareVersion;
        $firmware->save();

        return $firmware->id;
    }
}
