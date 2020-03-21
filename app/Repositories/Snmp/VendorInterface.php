<?php

namespace App\Repositories\Snmp;

interface VendorInterface
{
    public function getModel($snmpArray);

    public function getFirmware($snmpArray);

    public function getFirmwareVersion($snmpArray);

    public function getPacketsVersion($snmpArray);

    public function getUptime($snmpArray);

    public function getContact($snmpArray);

    public function getLocation($snmpArray);

    public function getSerialNumber($snmpArray);

    public function getHumanModel($snmpArray);

    public function getLicenseLevel($snmpArray);

    public function getPlatformType($snmpArray);
}
