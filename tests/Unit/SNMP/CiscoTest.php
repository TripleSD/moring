<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\ParseVendor;
use App\Repositories\Snmp\Vendors\Cisco;
use Tests\TestCase;

class CiscoTest extends TestCase
{
    public function testGetVendor(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new ParseVendor();
        $this->assertEquals('Cisco', $vendor->getName($snmpWalk));
    }

    public function testGetModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('WS-C3560-8PC-S', $vendor->getModel($snmpWalk));
    }

    public function testGetFirmware(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('Cisco IOS Software', $vendor->getFirmware($snmpWalk));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('12.2(35)SE5', $vendor->getFirmwareVersion($snmpWalk));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpWalk));
    }

    public function testGetUptime(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('294309196', $vendor->getUptime($snmpWalk));
    }

    public function testGetContact(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpWalk));
    }

    public function testGetLocation(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpWalk));
    }

    public function testGetSerialNumber(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals('FOC1217V38H', $vendor->getSerialNumber($snmpWalk));
    }

    public function testGetHumanModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals(null, $vendor->getHumanModel($snmpWalk));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $this->assertEquals(null, $vendor->getLicenseLevel($snmpWalk));
    }

    public function testGetPlatformType(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Cisco();
        $model    = $vendor->getModel($snmpWalk);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function getMockSnmpWalk(): array
    {
        $array    = [];
        $mockFile = fopen(__DIR__ . '/Mocks/Cisco/Hardware.src', 'r');
        while (! feof($mockFile)) {
            $line = fgets($mockFile);
            $line = explode('=', $line);

            if (empty($line[1])) {
                $array[$line[0]] = '';
            } else {
                $array[preg_replace('/ /', '', $line[0])] = $line[1];
            }
        }
        fclose($mockFile);

        return $array;
    }
}
