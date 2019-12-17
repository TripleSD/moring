<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;

class SnmpRepository extends Repository
{
    public function getInfo($community, $version, $ip, $oid)
    {
        return shell_exec("/usr/bin/snmpwalk -$version -c$community $ip $oid");
    }
}
