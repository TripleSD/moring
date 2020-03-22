<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\ParseVendor;
use Tests\TestCase;
use App\Repositories\Snmp\Vendors\Eltex;

class EltexTest extends TestCase
{
    public function testGetVendor(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new ParseVendor();
        $this->assertEquals('Eltex', $vendor->getName($snmpWalk));
    }

    public function testGetModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('MES2324B', $vendor->getModel($snmpWalk));
    }

    public function testGetFirmware(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('Eltex Linux', $vendor->getFirmware($snmpWalk));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('4.0.7', $vendor->getFirmwareVersion($snmpWalk));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals(null, $vendor->getPacketsVersion($snmpWalk));
    }

    public function testGetUptime(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('2409917400', $vendor->getUptime($snmpWalk));
    }

    public function testGetContact(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpWalk));
    }

    public function testGetLocation(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpWalk));
    }

    public function testGetSerialNumber(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals('ES32001131', $vendor->getSerialNumber($snmpWalk));
    }

    public function testGetHumanModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals(null, $vendor->getHumanModel($snmpWalk));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $this->assertEquals(null, $vendor->getLicenseLevel($snmpWalk));
    }

    public function testGetPlatformType(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Eltex();
        $model    = $vendor->getModel($snmpWalk);
        $this->assertEquals(0, $vendor->getPlatformType($model));
    }

    private function getMockSnmpWalk(): array
    {
        $array    = [];
        $mockFile = fopen(__DIR__ . '/Mocks/Eltex/Hardware.src', 'r');
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
