<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesVendorsRepository;
use Tests\TestCase;

class DeviceVendorTest extends TestCase
{
    public function testStoreVendor(): void
    {
        $device = new DevicesVendorsRepository();
        $this->assertEquals(null, $device->getVendor('TestVendor1'));
        $device->storeVendor('TestVendor1');
        $this->assertEquals(1, $device->getVendorId('TestVendor1'));
        $this->assertDatabaseHas('devices_vendors', ['title' => 'TestVendor1']);
        $this->assertEquals(2, $device->getVendorId('TestVendor2'));
        $this->assertDatabaseHas('devices_vendors', ['title' => 'TestVendor2']);
    }

    public function testGetVendor(): void
    {
        $device = new DevicesVendorsRepository();
        $this->assertEquals(null, $device->getVendor('TestVendor1'));
        $this->assertDatabaseMissing('devices_vendors', ['title' => 'TestVendor1']);
        $this->assertEquals(1, $device->getVendorId('TestVendor1'));
        $this->assertDatabaseHas('devices_vendors', ['title' => 'TestVendor1']);
        $this->assertEquals(null, $device->getVendor('TestVendor2'));
        $this->assertDatabaseMissing('devices_vendors', ['title' => 'TestVendor2']);
    }

    public function testGetVendorId(): void
    {
        $device = new DevicesVendorsRepository();
        $this->assertDatabaseMissing('devices_vendors', ['title' => 'TestVendor1']);
        $this->assertEquals(1, $device->getVendorId('TestVendor1'));
        $this->assertDatabaseHas('devices_vendors', ['title' => 'TestVendor1']);
        $this->assertDatabaseMissing('devices_vendors', ['title' => 'TestVendor2']);
        $this->assertEquals(2, $device->getVendorId('TestVendor2'));
        $this->assertDatabaseHas('devices_vendors', ['title' => 'TestVendor2']);
    }
}
