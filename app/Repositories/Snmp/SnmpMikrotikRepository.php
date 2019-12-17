<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;

class SnmpMikrotikRepository extends Repository
{
    private $snmpRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
    }

    public function getVersion($community, $ip)
    {
        $oid = 'SNMPv2-SMI::mib-2.47.1.1.1.1.2.65536';
        $response = $this->snmpRepository->getInfo($ip, $community, $oid);
        $result = preg_replace('/SNMPv2-SMI::mib-2.47.1.1.1.1.2.65536 = STRING:/', '', $response);
        preg_match('/[0-9.]+/', $result, $match);

        return trim($match[0]);
    }

    public function getModel($community, $ip)
    {
        $oid = 'SNMPv2-MIB::sysDescr.0';
        $response = $this->snmpRepository->getInfo($ip, $community, $oid);
        $result = preg_replace('/SNMPv2-MIB::sysDescr.0 = STRING: RouterOS/', '', $response);

        return trim($result);
    }
}
