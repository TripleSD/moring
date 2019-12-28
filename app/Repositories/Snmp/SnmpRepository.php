<?php

namespace App\Repositories\Snmp;

use App\Repositories\Repository;
use Exception;
use SNMP;

class SnmpRepository extends Repository
{
    /**
     * @param $host
     * @param $community
     * @return SNMP
     * @throws Exception
     */
    public function getSnmpFlow($host, $community)
    {
        return new SNMP(SNMP::VERSION_2c, $host, $community,10000);
    }

    /**
     * @param $snmpFlow
     * @return string
     * @throws Exception
     */
    public function getVendor($snmpFlow): string
    {
        $vendor = (string) null;

        try {
            $string = $snmpFlow->get('SNMPv2-MIB::sysLocation.0');
        } catch (Exception $exception) {
            throw new Exception('Устройство не отвечает.');
        }

        try {
            $string = $snmpFlow->get('1.3.6.1.2.1.1.1.0');
        } catch (Exception $exception) {
            throw new Exception('MIB не содержит данных о производителе.');
        }

        if (preg_match('/RouterOS/', $string)) {
            $vendor = 'MikroTik';
        }

        if (preg_match('/Cisco/', $string)) {
            $vendor = 'Cisco';
        }

        if (preg_match('/DGS-/', $string)) {
            $vendor = 'D-Link';
        } elseif (preg_match('/DES-/', $string)) {
            $vendor = 'D-Link';
        }

        if (preg_match('/MES/', $string)) {
            $vendor = 'Eltex';
        }

        return (string) $vendor;
    }
}
