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
    public function getVendorId(string $vendorTitle): int
    {
        $vendor = $this->getVendor($vendorTitle);

        if (empty($vendor)) {
            $vendor = $this->storeVendor($vendorTitle);
        }

        return $vendor->id;
    }

    /**
     * @param string $vendorTitle
     * @return object|null
     */
    public function getVendor(string $vendorTitle): ?object
    {
        return DevicesVendors::where('title', $vendorTitle)->first();
    }


    /**
     * @param string $vendorTitle
     * @return object|null
     */
    public function storeVendor(string $vendorTitle): ?object
    {
        $vendor        = new DevicesVendors();
        $vendor->title = $vendorTitle;
        $vendor->save();

        return $vendor;
    }
}
