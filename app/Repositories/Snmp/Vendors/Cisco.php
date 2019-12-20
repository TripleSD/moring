<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;

class Cisco extends Repository
{
    private $snmpRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
    }

    public function getModel($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.13.1001');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);
        return trim($string);
    }

    public function getFirmware($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysDescr.0');
        preg_match('/Cisco IOS Software/', $string, $match);
        return $match[0];
    }

    public function getFirmwareVersion($snmpFlow)
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.9.1001');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getPacketsVersion($snmpFlow)
    {
        return null;
    }

    public function getUptime($snmpFlow)
    {
        $string = $snmpFlow->get('.1.3.6.1.2.1.1.3.0');
        preg_match('/\((\d+)\)/', $string, $string);
        preg_match('/\d+/', $string[1], $string);

        return trim($string[0]);
    }

    public function getContact($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysContact.0');
        $string = str_replace('STRING: ', '', $string);

        return trim($string);
    }

    public function getLocation($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysLocation.0');
        $string = str_replace('STRING: ', '', $string);

        return trim($string);
    }

    public function getSerialnNumber($snmpFlow)
    {
        try {
            $string = $snmpFlow->get('.1.3.6.1.2.1.47.1.1.1.1.11.1001');
            $string = str_replace('STRING: ', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getHumanModel($snmpFlow)
    {
        return null;
    }

    public function getLicenseLevel($snmpFlow)
    {
        return null;
    }

    public function getPlarformType($model)
    {
        return (int) 0;
    }
}
