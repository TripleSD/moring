<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Snmp\VendorInterface;
use SNMP;

class Eltex implements VendorInterface
{
    /**
     * @param $snmpFlow
     * @return string
     */
    public function getModel($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.13.67108992'));
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

        return (string) 'Eltex Linux';
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getFirmwareVersion($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.10.67108992'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     */
    public function getPacketsVersion($snmpFlow): void
    {
        /* @var SNMP $snmpFlow */
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

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getSerialNumber($snmpFlow): string
    {
        /* @var SNMP $snmpFlow */
        $string = str_replace('STRING: ', '', $snmpFlow->get('1.3.6.1.2.1.47.1.1.1.1.11.67108992'));
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     */
    public function getHumanModel($snmpFlow): void
    {
        /* @var SNMP $snmpFlow */
    }

    /**
     * @param $snmpFlow
     */
    public function getLicenseLevel($snmpFlow): void
    {
        /* @var SNMP $snmpFlow */
    }

    /**
     * @param $snmpFlow
     * @return int
     */
    public function getPlatformType($snmpFlow): int
    {
        /* @var SNMP $snmpFlow */

        return (int) 0;
    }
}
