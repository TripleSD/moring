<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;
use SNMP;

class SnmpRepository extends Repository
{
    public function startSession($varsConnection)
    {
        return new SNMP(
            SNMP::VERSION_2c,
            $varsConnection['hostname'] . ':' . $varsConnection['port'], $varsConnection['community']
        );
    }

    public function getVendorNameRawString($snmpFlow)
    {
        /** @var SNMP $snmpFlow */
        return $snmpFlow->get('1.3.6.1.2.1.1.1.0');
    }
}
