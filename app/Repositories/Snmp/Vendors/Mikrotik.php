<?php

namespace App\Repositories\Snmp\Vendors;

use SNMP;
use App\Repositories\Snmp\VendorInterface;

class Mikrotik implements VendorInterface
{
    public function getModel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('SNMPv2-MIB::sysDescr.0');
        $string    = $snmpArray['SNMPv2-MIB::sysDescr.0'];
        $string    = str_replace('STRING: RouterOS ', '', $string);

        return $string;
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getFirmware($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.2.1.1.1.0');
        $string    = $snmpArray['SNMPv2-MIB::sysDescr.0'];
        $string    = str_replace('STRING: ', '', $string);
        $string    = explode(' ', $string);

        return (string) trim($string[0]);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getFirmwareVersion($snmpFlow): ?string
    {
        try {
            /* @var SNMP $snmpFlow */
            $snmpArray = $snmpFlow->walk('1.3.6.1.4.1.14988.1.1.7.4.0');
            $string    = $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.7.4.0'];
            $string    = str_replace('STRING: ', '', $string);
            $string    = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getPacketsVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.4.1.14988.1.1.4.4.0');
        $string    = str_replace('STRING: ', '', $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.4.4.0']);
        $string    = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getUptime($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.2.1.1.3.0');
        preg_match('/\d+/', $snmpArray['DISMAN-EVENT-MIB::sysUpTimeInstance'], $string);

        return (string) trim($string[0]);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getContact($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.2.1.1.4.0');
        $string    = str_replace('STRING: ', '', $snmpArray['SNMPv2-MIB::sysContact.0']);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLocation($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.2.1.1.6.0');
        $string    = str_replace('STRING: ', '', $snmpArray['SNMPv2-MIB::sysLocation.0']);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getSerialNumber($snmpFlow): ?string
    {
        try {
            /* @var SNMP $snmpFlow */
            $snmpArray = $snmpFlow->walk('1.3.6.1.4.1.14988.1.1.7.3.0');
            $string = str_replace('STRING: ', '', $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.7.3.0']);
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getHumanModel($snmpFlow): ?string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.2.1.1.1.0');
        $string    = str_replace('STRING: RouterOS ', '', $snmpArray['SNMPv2-MIB::sysDescr.0']);
        $string    = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLicenseLevel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpArray = $snmpFlow->walk('1.3.6.1.4.1.14988.1.1.4.3.0');
        $string    = str_replace('INTEGER: ', '', $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.4.3.0']);

        return (string) trim($string);
    }

    /**
     * @param $modelName
     * @return int
     */
    public function getPlatformType($modelName): int
    {
        if ($modelName === 'CHR') {
            return (int) 1;
        } else {
            return (int) 0;
        }
    }
}
