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
}
