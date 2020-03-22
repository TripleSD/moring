<?php

namespace App\Repositories\Snmp;

class ParseVendor
{
    public function getName(array $snmpFlow): string
    {
        if (isset($snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
            if (preg_match('/RouterOS/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Mikrotik';
            }

            if (preg_match('/Cisco/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Cisco';
            }

            if (preg_match('/[D][EG][S]/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'D-Link';
            }

            if (preg_match('/MES/', $snmpFlow['SNMPv2-MIB::sysDescr.0'])) {
                return 'Eltex';
            }
        }

        return (string) null;
    }
}
