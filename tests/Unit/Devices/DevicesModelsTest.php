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
    }

    public function testGetModel()
    {
        $device = new DevicesModelsRepository();
        $this->assertEquals(null, $device->getModel('TestModel1'));
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestModel1']);
        $this->assertEquals(1, $device->getModelId('TestModel1'));
        $this->assertDatabaseHas('devices_models', ['title' => 'TestModel1']);
        $this->assertDatabaseMissing('devices_models', ['title' => 'TestModel2']);
    }

    public function testGetModelId()
    {
        $device = new DevicesModelsRepository();
        $this->assertEquals(1, $device->getModelId('TestModel1'));
        $this->assertEquals(1, $device->getModelId('TestModel1'));
        $this->assertEquals(2, $device->getModelId('TestModel2'));
    }
}
