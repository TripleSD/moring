<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;
use SNMP;

class SnmpRepository extends Repository
{
    public function startSession($varsConnection)
    {
        return new SNMP(SNMP::VERSION_2c, $varsConnection['hostname'], $varsConnection['snmpCommunity']);
    }

    public function name($nameArray)
    {
        return $nameArray['1.3.6.1.2.1.1.1.0'];
    }
}
