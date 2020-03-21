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
    public function getFirmwareId(string $firmwareTitle, string $firmwareVersion = null): int
    {
        $firmware = $this->getFirmware($firmwareTitle, $firmwareVersion);

        if ($firmware === null) {
            $firmware = $this->storeFirmware($firmwareTitle, $firmwareVersion);
        }

        return $firmware->id;
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return object|null
     */
    private function getFirmware(string $firmwareTitle, string $firmwareVersion = null): ?object
    {
        return DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return object|null
     */
    private function storeFirmware(string $firmwareTitle, string $firmwareVersion = null): ?object
    {
        $firmware          = new DevicesFirmwares();
        $firmware->title   = $firmwareTitle;
        $firmware->version = $firmwareVersion;
        $firmware->save();

        return $firmware;
    }
}
