<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;
use SNMP;

class SnmpRepository extends Repository
{
    public function getSnmpFlow($host, $community)
    {
        // TODO восстановить try/catch
        $snmpFlow = new SNMP(SNMP::VERSION_2c, $host, $community);
        return $snmpFlow->walk(".");
    }

    public function getVendor(array $snmpFlow): string
    {
        if (preg_match('/RouterOS/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            $vendor = 'Mikrotik';
        }

        if (preg_match('/Cisco/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            $vendor = 'Cisco';
        }

        if (preg_match('/[D][EG][S]/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            $vendor = 'D-Link';
        }

        if (preg_match('/MES/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            $vendor = 'Eltex';
        }

        return (string) $vendor;
    }
}
