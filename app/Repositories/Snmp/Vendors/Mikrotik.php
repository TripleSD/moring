<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;

class Mikrotik implements VendorInterface
{
    /**
     * @param $snmpArray
     * @return string
     */
    public function getModel($snmpArray): string
    {
        if (isset($snmpArray['SNMPv2-MIB::sysDescr.0'])) {
            $string = str_replace('STRING: RouterOS ', '', $snmpArray['SNMPv2-MIB::sysDescr.0']);
            $string = preg_replace('/\n/', '', $string);
            return preg_replace('/ /', '', $string);
        } else {
            return (string) null;
        }
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getFirmware($snmpArray): string
    {
        $string = str_replace('STRING: ', '',$snmpArray['SNMPv2-MIB::sysDescr.0']);
        $string = explode(' ', $string);

        return (string) trim($string[1]);
    }

    /**
     * @param $snmpArray
     * @return string|null
     */
    public function getFirmwareVersion($snmpArray): ?string
    {
        try {
            $string = $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.7.4.0'];
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getPacketsVersion($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.4.4.0'];
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getUptime($snmpArray): string
    {
        if (isset($snmpArray['DISMAN-EVENT-MIB::sysUpTimeInstance'])) {
            preg_match('/\((\d+)\)/', $snmpArray['DISMAN-EVENT-MIB::sysUpTimeInstance'], $string);
            preg_match('/\d+/', $string[1], $string);

            return (string) trim($string[0]);
        } else {
            return (string) null;
        }
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getContact($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-MIB::sysContact.0'];
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getLocation($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-MIB::sysLocation.0'];
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpArray
     * @return string|null
     */
    public function getSerialNumber($snmpArray): ?string
    {
        try {
            $string = $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.7.3.0'];
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpArray
     * @return string|null
     */
    public function getHumanModel($snmpArray): ?string
    {
        try {
            $string = $snmpArray['SNMPv2-MIB::sysDescr.0'];
            $string = str_replace('STRING: RouterOS ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getLicenseLevel($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-SMI::enterprises.14988.1.1.4.3.0'];
        $string = str_replace('INTEGER: ', '', $string);

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
