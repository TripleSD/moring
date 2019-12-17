<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;

class SnmpRepository extends Repository
{
    public function getInfo($host, $community, $oid)
    {
        return snmp2_get($host, $community, $oid);
    }
}
