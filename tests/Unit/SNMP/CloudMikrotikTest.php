<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\ParseVendor;
use App\Repositories\Snmp\Vendors\Mikrotik;
use Tests\TestCase;

class CloudMikrotikTest extends TestCase
{
    public function testGetVendor(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new ParseVendor();
        $this->assertEquals('Mikrotik', $vendor->getName($snmpWalk));
    }

    public function testGetModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('CHR', $vendor->getModel($snmpWalk));
    }

    public function testGetFirmware(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('RouterOS', $vendor->getFirmware($snmpWalk));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals(null, $vendor->getFirmwareVersion($snmpWalk));
    }

    public function testGetPacketsVersion(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('6.46.4', $vendor->getPacketsVersion($snmpWalk));
    }

    public function testGetUptime(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('199892900', $vendor->getUptime($snmpWalk));
    }

    public function testGetContact(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('admin@mail.test', $vendor->getContact($snmpWalk));
    }

    public function testGetLocation(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('DC Super', $vendor->getLocation($snmpWalk));
    }

    public function testGetSerialNumber(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals(null, $vendor->getSerialNumber($snmpWalk));
    }

    public function testGetHumanModel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals('CHR', $vendor->getHumanModel($snmpWalk));
    }

    public function testGetLicenseLevel(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $this->assertEquals(1, $vendor->getLicenseLevel($snmpWalk));
    }

    public function testGetPlatformType(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new Mikrotik();
        $model    = $vendor->getModel($snmpWalk);
        $this->assertEquals(1, $vendor->getPlatformType($model));
    }

    private function getMockSnmpWalk(): array
    {
        $array    = [];
        $mockFile = fopen(__DIR__ . '/Mocks/Mikrotik/Cloud.src', 'r');
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
