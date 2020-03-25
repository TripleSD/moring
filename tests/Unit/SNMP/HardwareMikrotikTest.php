<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Mikrotik;
use Tests\TestCase;

class HardwareMikrotikTest extends TestCase
{
    public function testGetModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('RB751U-2HnD', $vendor->getModel($snmpConnection));
    }

    public function testGetFirmware(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('RouterOS', $vendor->getFirmware($snmpConnection));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('6.46', $vendor->getFirmwareVersion($snmpConnection));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('6.46.4', $vendor->getPacketsVersion($snmpConnection));
    }

    public function testGetUptime(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('199964800', $vendor->getUptime($snmpConnection));
    }

    public function testGetContact(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpConnection));
    }

    public function testGetLocation(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpConnection));
    }

    public function testGetSerialNumber(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('45E4028BDAC3', $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals(4, $vendor->getLicenseLevel($snmpConnection));
    }

    public function testGetPlatformType(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $model  = $vendor->getModel($snmpConnection);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '127.0.0.1:9005';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
