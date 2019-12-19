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
        $string = $snmpFlow->get('SNMPv2-MIB::sysName.0');
        return str_replace('STRING: ', '', $string);
    }
}
