<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesFirmwaresRepository;
use Tests\TestCase;

class FirmwareTest extends TestCase
{
    public function testStoreFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEquals(null, $device->getFirmware('TestVendor1'));
        $device->storeFirmware('TestVendor1');
        $this->assertEquals(1, $device->getFirmwareId('TestVendor1'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertEquals(2, $device->getFirmwareId('TestVendor2'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor2']);
    }

    public function testGetFirmware(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertEquals(null, $device->getFirmware('TestVendor1'));
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertEquals(1, $device->getFirmwareId('TestVendor1'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertEquals(null, $device->getFirmware('TestVendor2'));
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor2']);
    }

    public function testGetFirmwareId(): void
    {
        $device = new DevicesFirmwaresRepository();
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertEquals(1, $device->getFirmwareId('TestVendor1'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor1']);
        $this->assertDatabaseMissing('devices_firmwares', ['title' => 'TestVendor2']);
        $this->assertEquals(2, $device->getFirmwareId('TestVendor2'));
        $this->assertDatabaseHas('devices_firmwares', ['title' => 'TestVendor2']);
    }
}
