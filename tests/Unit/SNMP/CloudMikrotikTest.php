<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Mikrotik;
use Tests\TestCase;

class CloudMikrotikTest extends TestCase
{
    public function testGetModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('CHR', $vendor->getModel($snmpConnection));
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
        $this->assertEquals(null, $vendor->getFirmwareVersion($snmpConnection));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpConnection));
    }

    public function testGetUptime(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals('199892900', $vendor->getUptime($snmpConnection));
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
        $this->assertEquals(null, $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $this->assertEquals(1, $vendor->getLicenseLevel($snmpConnection));
    }

    public function testGetPlatformType(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Mikrotik();
        $model  = $vendor->getModel($snmpConnection);
        $this->assertEquals(1, $vendor->getPlatformType($model));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '127.0.0.1:9001';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
