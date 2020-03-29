<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;
use SNMP;

class Mikrotik implements VendorInterface
{
    public function getModel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('"', '', $snmpFlow->get('1.3.6.1.2.1.1.1.0'));
        $string = str_replace('STRING: RouterOS ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getFirmware($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.1.1.0'));
        $string = explode(' ', $string);
        $string = str_replace('"', '', $string[0]);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getFirmwareVersion($snmpFlow): ?string
    {
        try {
            /* @var SNMP $snmpFlow */
            $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.4.1.14988.1.1.7.4.0'));
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
        }

        return null;
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getPacketsVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.4.1.14988.1.1.4.4.0'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getUptime($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        preg_match('/\d+/', $snmpFlow->get('1.3.6.1.2.1.1.3.0'), $match);
        $string = str_replace('"', '', $match[0]);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getContact($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.1.4.0'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLocation($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.1.6.0'));
        $string = str_replace('"', '', $string);

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
            $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.4.1.14988.1.1.7.3.0'));
            $string = str_replace('"', '', $string);

            return trim($string);
        } catch (\Exception $e) {
        }

        return null;
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLicenseLevel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('INTEGER: ', '', $snmpFlow->get('1.3.6.1.4.1.14988.1.1.4.3.0'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $modelName
     * @return int
     */
    public function getPlatformType($modelName): int
    {
        /* @var VendorInterface $modelName */
        if ($modelName === 'CHR') {
            return (int) 1;
        }

        return (int) 0;
    }
}
