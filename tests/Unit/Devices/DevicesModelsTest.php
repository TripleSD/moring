<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesModelsRepository;
use Tests\TestCase;

class DevicesModelsTest extends TestCase
{
    public function testStoreFirmware(): void
    {
        $device = new DevicesModelsRepository();
        $this->assertEquals(null, $device->getModel('TestModel1'));
        $device->storeModel('TestModel1');
        $this->assertEquals(1, $device->getModelId('TestModel1'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestModel1']);
        $this->assertEquals(2, $device->getModelId('TestModel2'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestModel2']);
    }

    public function testGetModel(): void
    {
        $device = new DevicesModelsRepository();
        $this->assertEquals(null, $device->getModel('TestModel1'));
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestModel1']);
        $this->assertEquals(1, $device->getModelId('TestModel1'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestModel1']);
        $this->assertEquals(null, $device->getModel('TestModel2'));
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestModel2']);
    }

    public function testGetModelId(): void
    {
        $device = new DevicesModelsRepository();
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestVendor1']);
        $this->assertEquals(1, $device->getModelId('TestVendor1'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestVendor1']);
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestVendor2']);
        $this->assertEquals(2, $device->getModelId('TestVendor2'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestVendor2']);
    }
}
