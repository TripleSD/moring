<?php

namespace App\Repositories\Snmp;

use Exception;
use App\Repositories\Repository;
use SNMP;

class SnmpRepository extends Repository
{
    /**
     * @param $host
     * @param $community
     * @return SNMP
     */
    public function getSnmpFlow($host, $community)
    {
        return new SNMP(SNMP::VERSION_2c, $host, $community);
    }

    /**
     * @param $snmpFlow
     * @return string
     * @throws Exception
     */
    public function getVendor($snmpFlow)
    {
        $vendor = (string) null;

        try {
            $string = $snmpFlow->get('1.3.6.1.2.1.1.1.0');

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
        } catch (\Exception $e) {
            throw new Exception('SNMP поток получен, но определить производителя не удалось.');
        }

        return (string) $vendor;
    }
}
