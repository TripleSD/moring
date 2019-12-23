<?php

namespace App\Repositories\Snmp\Vendors;

use App\Repositories\Repository;
use App\Repositories\Snmp\SnmpRepository;

class Dlink extends Repository
{
    private $snmpRepository;

    public function __construct()
    {
        $this->snmpRepository = new SnmpRepository();
    }

    public function getModel($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.7.1');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    public function getFirmware($snmpFlow): string
    {
        return 'D-Link Linux';
    }

    public function getFirmwareVersion($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-SMI::mib-2.16.19.2.0');
        $string = str_replace('STRING: ', '', $string);
        $string = str_replace('"', '', $string);

        return (string) trim($string);
    }

    public function getPacketsVersion($snmpFlow): void
    {
        return;
    }

    public function getUptime($snmpFlow): string
    {
        $string = $snmpFlow->get('.1.3.6.1.2.1.1.3.0');
        preg_match('/\((\d+)\)/', $string, $string);
        preg_match('/\d+/', $string[1], $string);

        return (string) trim($string[0]);
    }

    public function getContact($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysContact.0');
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    public function getLocation($snmpFlow): string
    {
        $string = $snmpFlow->get('SNMPv2-MIB::sysLocation.0');
        $string = str_replace('STRING: ', '', $string);

        return (string) trim($string);
    }

    public function getSerialnNumber($snmpFlow): ?string
    {
        try {
            $string = $snmpFlow->get('SNMPv2-SMI::mib-2.47.1.1.1.1.11.1');
            $string = str_replace('STRING: ', '', $string);
            $string = str_replace('"', '', $string);

            return (string) trim($string);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getHumanModel($snmpFlow): void
    {
        return;
    }

    public function getLicenseLevel($snmpFlow): void
    {
        return;
    }

    public function getPlarformType($model): int
    {
        return (int) 0;
    }
}
