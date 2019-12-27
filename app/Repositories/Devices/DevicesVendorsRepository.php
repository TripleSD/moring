<?php

namespace App\Repositories\Devices;

use App\Models\DevicesVendors;
use App\Repositories\Repository;

class DevicesVendorsRepository extends Repository
{
    /**
     * @param string $vendorTitle
     * @return int
     */
    public function checkVendor(string $vendorTitle): int
    {
        $vendor = DevicesVendors::where('title', $vendorTitle)->first();
        if (empty($vendor)) {
            $vendor        = new DevicesVendors();
            $vendor->title = $vendorTitle;
            $vendor->save();

            return $vendor->id;
        } else {
            return $vendor->id;
        }
    }
}
