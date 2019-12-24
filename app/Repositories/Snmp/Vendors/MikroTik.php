<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;

class MikroTik extends Repository
{
    /** @var SnmpRepository */
    private $snmpRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getModel($snmpFlow): string
    {
        $string = $snmpFlow->get('1.3.6.1.2.1.1.1.0');

        return (string) str_replace('STRING: RouterOS ', '', $string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getFirmware($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysDescr.0');
        $string = explode(' ', $string);

        return (string) trim($string[1]);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getFirmwareVersion($snmpFlow): ?string
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.7.4.0');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

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
        $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.4.4.0');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getUptime($snmpFlow): string
    {
        $string = $snmpFlow->get('.1.3.6.1.2.1.1.3.0');
        preg_match('/\((\d+)\)/', $string, $string);
        preg_match('/\d+/', $string[1], $string);

        return (string) trim($string[0]);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getContact($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysContact.0');
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLocation($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysLocation.0');
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $snmpFlow
     * @return string|null
     */
    public function getSerialNumber($snmpFlow): ?string
    {
        try {
            $string = $snmpFlow->get('1.3.6.1.4.1.14988.1.1.7.3.0');
            $string = str_replace('STRING: ', '', $string);

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
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.7.8.0');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpFlow
     * @return string
     */
    public function getLicenseLevel($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-SMI::enterprises.14988.1.1.4.3.0');
        $string = str_replace('INTEGER: ', '', $string);

        return (string) trim($string);
    }

    /**
     * @param $model
     * @return int
     */
    public function getPlatformType($model): int
    {
        if ($model === 'CHR') {
            return (int) 1;
        } else {
            return (int) 0;
        }
    }
}
