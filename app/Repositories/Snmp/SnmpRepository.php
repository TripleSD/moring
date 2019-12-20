<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;
use SNMP;

class SnmpRepository extends Repository
{
    public function getSnmpFlow($host, $community)
    {
        return new SNMP(SNMP::VERSION_2c, $host, $community);
    }

    public function getVendor($snmpFlow)
    {
        $vendor = (string) null;

        $string = $snmpFlow->get('1.3.6.1.2.1.1.1.0');

        if (preg_match('/RouterOS/', $string)) {
            $vendor = 'MikroTik';
        }

        if (preg_match('/Cisco/', $string)) {
            $vendor = 'Cisco';
        }

        return (string) $vendor;
    }
}
