<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Cisco;
use Tests\TestCase;

class CiscoTest extends TestCase
{
    public function testGetModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('WS-C3560-8PC-S', $vendor->getModel($snmpConnection));
    }

    public function testGetFirmware(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('Cisco IOS Software', $vendor->getFirmware($snmpConnection));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('12.2(35)SE5', $vendor->getFirmwareVersion($snmpConnection));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpConnection));
    }

    public function testGetUptime(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('294309196', $vendor->getUptime($snmpConnection));
    }

    public function testGetContact(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpConnection));
    }

    public function testGetLocation(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpConnection));
    }

    public function testGetSerialNumber(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals('FOC1217V38H', $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetHumanModel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals(null, $vendor->getHumanModel($snmpConnection));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $this->assertEquals(null, $vendor->getLicenseLevel($snmpConnection));
    }

    public function testGetPlatformType(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());

        $vendor = new Cisco();
        $model  = $vendor->getModel($snmpConnection);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '127.0.0.1:9002';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
