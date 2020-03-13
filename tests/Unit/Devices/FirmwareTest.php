<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesFirmwaresRepository;
use Tests\TestCase;

class FirmwareTest extends TestCase
{
    public function testStoreFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEquals(1, $device->storeFirmware('TestVendor1'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertEquals(2, $device->storeFirmware('TestVendor2'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor2']);
    }

    public function testGetNotEmptyFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $device->storeFirmware('TestVendor');
        $this->assertNotEmpty($device->getFirmwareId('TestVendor'));
        $this->assertEquals(1, $device->getFirmwareId('TestVendor'));
    }

//    public function testGetEmptyFirmware(): void
//    {
//        $device = new DevicesFirmwaresRepository();
//        $this->assertEquals(null, $device->getFirmwareId('TestVendor'));
//        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor']);
//    }
//
//    public function testCheckFirmware()
//    {
//        $device = new DevicesFirmwaresRepository();
//        $this->assertEquals(1, $device->checkFirmwareId('TestVendor'));
//        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor']);
//    }
}
