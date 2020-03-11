<?php

namespace App\Repositories\Devices;

use App\Models\DevicesFirmwares;
use App\Repositories\Repository;

class DevicesFirmwaresRepository extends Repository
{
    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return int
     */
    public function checkFirmware(string $firmwareTitle, string $firmwareVersion = null): int
    {
        $firmware = $this->getFirmware($firmwareTitle, $firmwareVersion);

        if (empty($firmware)) {
            return $this->setFirmware($firmwareTitle, $firmwareVersion);
        }

        return $firmware->id;
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return mixed
     */
    public function getFirmware(string $firmwareTitle, string $firmwareVersion = null)
    {
        return DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return mixed
     */
    public function setFirmware(string $firmwareTitle, string $firmwareVersion = null)
    {
        $firmware          = new DevicesFirmwares();
        $firmware->title   = $firmwareTitle;
        $firmware->version = $firmwareVersion;
        $firmware->save();

        return $firmware->id;
    }
}
