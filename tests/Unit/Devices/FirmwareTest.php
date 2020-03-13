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
        $device   = new DevicesFirmwaresRepository();

        $deviceId = $device->storeFirmware('TestVendor1');
        $this->assertNotEmpty($device->getFirmwareId('TestVendor1'));
        $this->assertEquals($deviceId, $device->getFirmwareId('TestVendor1'));

        $deviceId = $device->storeFirmware('TestVendor2');
        $this->assertNotEmpty($device->getFirmwareId('TestVendor2'));
        $this->assertEquals($deviceId, $device->getFirmwareId('TestVendor2'));
    }

    public function testGetEmptyFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();

        $this->assertEquals(null, $device->getFirmwareId('TestVendor1'));
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor1']);

        $this->assertEquals(null, $device->getFirmwareId('TestVendor2'));
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor2']);
    }

    public function testCheckFirmware()
    {
        $device = new DevicesFirmwaresRepository();

        $this->assertEquals(1, $device->checkFirmwareId('TestVendor1'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor1']);

        $this->assertEquals(2, $device->checkFirmwareId('TestVendor2'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor2']);
    }
}
