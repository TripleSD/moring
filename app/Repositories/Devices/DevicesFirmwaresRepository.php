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
    public function checkFirmwareId(string $firmwareTitle, string $firmwareVersion = null): int
    {
        $firmwareId = $this->getFirmwareId($firmwareTitle, $firmwareVersion);

        if ($firmwareId === null) {
            $firmwareId = $this->storeFirmware($firmwareTitle, $firmwareVersion);
        }

        return $firmwareId;
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return mixed
     */
    public function getFirmwareId(string $firmwareTitle, string $firmwareVersion = null)
    {
        $device = DevicesFirmwares::where('title', $firmwareTitle)
            ->where('version', $firmwareVersion)
            ->first();

        if (empty($device)) {
            return null;
        }

        return $device->id;
    }

    /**
     * @param string $firmwareTitle
     * @param string|null $firmwareVersion
     * @return mixed
     */
    public function storeFirmware(string $firmwareTitle, string $firmwareVersion = null)
    {
        $firmware          = new DevicesFirmwares();
        $firmware->title   = $firmwareTitle;
        $firmware->version = $firmwareVersion;
        $firmware->save();

        return $firmware->id;
    }
}
