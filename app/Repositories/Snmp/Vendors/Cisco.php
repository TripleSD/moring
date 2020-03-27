<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;
use SNMP;

class Cisco implements VendorInterface
{
    /**
     * @param $snmpFlow
     * @return string
     */
    public function getModel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.13.1001'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getFirmware($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        preg_match('/Cisco IOS Software/', $snmpFlow->get('1.3.6.1.2.1.1.1.0'), $match);
        $string = str_replace('"', '', $match[0]);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getFirmwareVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.9.1001'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getPacketsVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpFlow->close();

        return (string) null;
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
    public function getSerialNumber($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.11.1001'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLicenseLevel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $snmpFlow->close();

        return (string) null;
    }

    /**
     * @param $snmpFlow
     * @return int
     */
    public function getPlatformType($snmpFlow): int
    {
        return (int) 0;
    }
}
