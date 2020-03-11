<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesFirmwaresRepository;
use Tests\TestCase;

class FirmwareTest extends TestCase
{
    public function testSetFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEquals(1, $device->setFirmware('TestVendor1'));
        $this->assertEquals(2, $device->setFirmware('TestVendor2'));
    }

    public function testGetNotEmptyFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $device->setFirmware('TestVendor');
        $this->assertNotEmpty($device->getFirmware('TestVendor'));
    }

    public function testGetEmptyFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEmpty($device->getFirmware('TestVendor'));
    }

    public function testCheckFirmware()
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEquals(1,$device->checkFirmware('TestVendor'));
    }
}
