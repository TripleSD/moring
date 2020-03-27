<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\DLink;
use Tests\TestCase;

class DLinkTest extends TestCase
{
    public function testGetModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('DGS-3000-10TC', $vendor->getModel($snmpConnection));
    }

    public function testGetFirmware(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('D-Link Linux', $vendor->getFirmware($snmpConnection));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('1.16.B002', $vendor->getFirmwareVersion($snmpConnection));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpConnection));
    }

    public function testGetUptime(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('2520849600', $vendor->getUptime($snmpConnection));
    }

    public function testGetContact(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpConnection));
    }

    public function testGetLocation(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpConnection));
    }

    public function testGetSerialNumber(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals('RZ1O1DA000532', $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $this->assertEquals(null, $vendor->getLicenseLevel($snmpConnection));
    }

    public function testGetPlatformType(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new DLink();
        $model  = $vendor->getModel($snmpConnection);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function setVarsConnection()
    {
        $array['hostname']  = '127.0.0.1:9003';
        $array['community'] = 'public';

        return $array;
    }
}
