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

    public function getModel($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.13.1001');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    public function getFirmware($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysDescr.0');
        preg_match('/Cisco IOS Software/', $string, $match);

        return (string) $match[0];
    }

    public function getFirmwareVersion($snmpFlow): ?string
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.9.1001');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpFlow
     */
    public function getPacketsVersion($snmpFlow): void
    {
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
            $string = $snmpFlow->get('.1.3.6.1.2.1.47.1.1.1.1.11.1001');
            $string = str_replace('STRING: ', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $snmpFlow
     */
    public function getHumanModel($snmpFlow): void
    {
    }

    /**
     * @param $snmpFlow
     */
    public function getLicenseLevel($snmpFlow): void
    {
    }

    /**
     * @param $model
     * @return int
     */
    public function getPlatformType($model): int
    {
        return (int) 0;
    }
}
