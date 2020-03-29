<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;
use SNMP;

class DLink implements VendorInterface
{
    /**
     * @param $snmpFlow
     * @return string
     */
    public function getModel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.7.1'));
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
        $snmpFlow->close();

        return (string) 'D-Link Linux';
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getFirmwareVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.16.19.2.0'));
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
        preg_match('/\d+/', $snmpFlow->get('1.3.6.1.2.1.1.3.0'), $string);

        return (string) trim($string[0]);
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
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.11.1'));
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
     * @param $modelName
     * @return int
     */
    public function getPlatformType($modelName): int
    {
        /* @var VendorInterface $modelName */
        unset($modelName);

        return (int) 0;
    }
}
