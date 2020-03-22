<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;

class Cisco implements VendorInterface
{
    /**
     * @param $snmpArray
     * @return string
     */
    public function getModel($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-SMI::mib-2.47.1.1.1.1.13.1001'];
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getFirmware($snmpArray): string
    {
        $string = $snmpArray['SNMPv2-MIB::sysDescr.0'];
        preg_match('/Cisco IOS Software/', $string, $match);

        return (string) $match[0];
    }

    /**
     * @param $snmpArray
     * @return string|null
     */
    public function getFirmwareVersion($snmpArray): ?string
    {
        try {
            $string = $snmpArray['SNMPv2-SMI::mib-2.47.1.1.1.1.9.1001'];
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpArray
     */
    public function getPacketsVersion($snmpArray): void
    {
    }

    /**
     * @param $snmpArray
     * @return string
     */
    public function getUptime($snmpArray): string
    {
        $string = $snmpArray['DISMAN-EVENT-MIB::sysUpTimeInstance'];
        preg_match('/\((\d+)\)/', $string, $string);
        preg_match('/\d+/', $string[1], $string);

        return (string) trim($string[0]);
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
            $string = $snmpArray['SNMPv2-SMI::mib-2.47.1.1.1.1.11.1'];
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpArray
     */
    public function getHumanModel($snmpArray): void
    {
    }

    /**
     * @param $snmpArray
     */
    public function getLicenseLevel($snmpArray): void
    {
    }

    /**
     * @param $snmpArray
     * @return int
     */
    public function getPlatformType($snmpArray): int
    {
        return (int) 0;
    }
}
