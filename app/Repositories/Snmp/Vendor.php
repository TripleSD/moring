<?php

namespace App\Repositories\Snmp;

class Vendor
{
    public function parseName(array $snmpFlow): string
    {
        if (isset($snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            if (preg_match('/RouterOS/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Mikrotik';
            }

            if (preg_match('/Cisco/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Cisco';
            }

            if (preg_match('/[D][EG][S]/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'DLink';
            }

            if (preg_match('/MES/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Eltex';
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
