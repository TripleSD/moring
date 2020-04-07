<?php

namespace App\Repositories\Snmp;

interface VendorInterface
{
    public function getModel($snmpFlow);

    public function getFirmware($snmpFlow);

    public function getFirmwareVersion($snmpFlow);

    public function getPacketsVersion($snmpFlow);

    public function getUptime($snmpFlow);

    public function getContact($snmpFlow);

    public function getLocation($snmpFlow);

    public function getSerialNumber($snmpFlow);

    public function getLicenseLevel($snmpFlow);

    public function getPlatformType($modelName);
}
