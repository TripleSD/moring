<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesModelsRepository;
use Tests\TestCase;

class ModelTest extends TestCase
{
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
