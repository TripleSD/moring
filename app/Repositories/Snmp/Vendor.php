<?php

namespace App\Repositories\Snmp;

class Vendor
{
    public function parseName(string $rawString): string
    {
        if (isset($rawString)) {
            if (preg_match('/RouterOS/', $rawString)) {
                return (string) 'Mikrotik';
            }

            if (preg_match('/Cisco/', $rawString)) {
                return (string) 'Cisco';
            }

            if (preg_match('/[D][EG][S]/', $rawString)) {
                return (string) 'DLink';
            }

            if (preg_match('/MES/', $rawString)) {
                return (string) 'Eltex';
            }
        }

        return (string) null;
    }

    public function getVendorClass($vendorName)
    {
        $classPath = '\App\Repositories\Snmp\Vendors\\' . $vendorName;

        return new $classPath();
    }
}
