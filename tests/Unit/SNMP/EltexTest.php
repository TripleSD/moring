<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Eltex;
use Tests\TestCase;

class EltexTest extends TestCase
{
    public function testGetModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('MES2324B', $vendor->getModel($snmpConnection));
    }

    public function testGetFirmware(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('Eltex Linux', $vendor->getFirmware($snmpConnection));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('4.0.7', $vendor->getFirmwareVersion($snmpConnection));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpConnection));
    }

    public function testGetUptime(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('2409917400', $vendor->getUptime($snmpConnection));
    }

    public function testGetContact(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpConnection));
    }

    public function testGetLocation(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpConnection));
    }

    public function testGetSerialNumber(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals('ES32001131', $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $this->assertEquals(null, $vendor->getLicenseLevel($snmpConnection));
    }

    public function testGetPlatformType(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor   = new Eltex();
        $model    = $vendor->getModel($snmpConnection);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '127.0.0.1:9004';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
