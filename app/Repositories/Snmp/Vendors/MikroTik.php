<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;

class MikroTik extends Repository
{
    private $snmpRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
    }

    public function getModel($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysDescr.0');

        return str_replace('STRING: RouterOS ', '', $string);
    }

    public function getFirmware($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysDescr.0');
        $string = explode(' ', $string);

        return trim($string[1]);
    }

    public function getFirmwareVersion($snmpFlow)
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.7.4.0');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return (string) null;
        }
    }

    public function getPacketsVersion($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.4.4.0');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return trim($string);
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
            $string = $snmpFlow->get('1.3.6.1.4.1.14988.1.1.7.3.0');
            $string = str_replace('STRING: ', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return (string) null;
        }
    }

    public function getHumanModel($snmpFlow)
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.7.8.0');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return (string) null;
        }
    }

    public function getLicenseLevel($snmpFlow)
    {
        $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.4.3.0');
        $string = str_replace('INTEGER: ', '', $string);

        return trim($string);
    }
}
