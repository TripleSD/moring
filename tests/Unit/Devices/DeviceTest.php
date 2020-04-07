<?php

namespace Tests\Unit\Devices;

use App\Repositories\Devices\DevicesRepository;
use Tests\TestCase;

class DeviceTest extends TestCase
{
    public function testStoreDevice(): void
    {
        $device = new DevicesRepository();
        $device->store($this->getDeviceData());
        $this->assertDatabaseHas('devices', ['id' => 1]);
        $this->assertDatabaseHas('devices', ['title' => '127.0.0.1']);
        $this->assertDatabaseHas('devices', ['hostname' => '127.0.0.1']);
        $this->assertDatabaseHas('devices', ['vendor_id' => 1]);
        $this->assertDatabaseHas('devices', ['model_id' => 1]);
        $this->assertDatabaseHas('devices', ['firmware_id' => 1]);
        $this->assertDatabaseHas('devices', ['uptime' => '00000000']);
        $this->assertDatabaseHas('devices', ['contact' => 'admin@test']);
        $this->assertDatabaseHas('devices', ['location' => 'DC Super 1']);
        $this->assertDatabaseHas('devices', ['license_level' => 1]);
        $this->assertDatabaseHas('devices', ['serial_number' => '00000000']);
        $this->assertDatabaseHas('devices', ['packets_version' => 1]);
        $this->assertDatabaseHas('devices', ['platform_type' => 1]);
        $this->assertDatabaseHas('devices', ['enabled' => 1]);
        $this->assertDatabaseHas('devices', ['port' => 161]);
        $this->assertDatabaseHas('devices', ['community' => 'public']);
        $this->assertDatabaseHas('devices', ['version' => 2]);
        $this->assertDatabaseHas('devices', ['port_ssh' => 22]);
        $this->assertDatabaseHas('devices', ['port_telnet' => 23]);
        $this->assertDatabaseHas('devices', ['web_url' => 'http://127.0.0.1:8080']);
    }

    public function testEditDevice(): void
    {
        $device = new DevicesRepository();
        $device->store($this->getDeviceData());
        $device = $device->edit(1);
        $this->assertEquals(1, $device->id);
    }

    public function testShowDevice(): void
    {
        $device = new DevicesRepository();
        $this->assertDatabaseMissing('devices', ['id', 1]);
        $device->store($this->getDeviceData());
        $this->assertDatabaseHas('devices', ['id' => 1]);
        $device = $device->show(1);
        $this->assertEquals(1, $device->id);
    }

    public function testDestroyDevice(): void
    {
        $this->assertDatabaseMissing('devices', ['id' => 1]);
        $device = new DevicesRepository();
        $device->store($this->getDeviceData());
        $this->assertDatabaseHas('devices', ['id' => 1]);
        $device->destroy(1);
        $this->assertDatabaseMissing('devices', ['id' => 1]);
    }

    public function testUpdateDevice(): void
    {
        $this->assertDatabaseMissing('devices', ['id' => 1]);
        $device = new DevicesRepository();
        $device->store($this->getDeviceData());
        $device->update($this->getDeviceDataForUpdate(), 1);
        $this->assertDatabaseHas('devices', ['id' => 1]);
        $this->assertDatabaseHas('devices', ['title' => '127.0.0.2']);
        $this->assertDatabaseHas('devices', ['hostname' => '127.0.0.2']);
        $this->assertDatabaseHas('devices', ['vendor_id' => 2]);
        $this->assertDatabaseHas('devices', ['model_id' => 2]);
        $this->assertDatabaseHas('devices', ['firmware_id' => 2]);
        $this->assertDatabaseHas('devices', ['uptime' => '11111111']);
        $this->assertDatabaseHas('devices', ['contact' => 'user@test']);
        $this->assertDatabaseHas('devices', ['location' => 'DC Super 2']);
        $this->assertDatabaseHas('devices', ['license_level' => 2]);
        $this->assertDatabaseHas('devices', ['serial_number' => '11111111']);
        $this->assertDatabaseHas('devices', ['packets_version' => 2]);
        $this->assertDatabaseHas('devices', ['platform_type' => 2]);
        $this->assertDatabaseHas('devices', ['enabled' => 0]);
        $this->assertDatabaseHas('devices', ['port' => 162]);
        $this->assertDatabaseHas('devices', ['community' => 'private']);
        $this->assertDatabaseHas('devices', ['version' => 3]);
        $this->assertDatabaseHas('devices', ['port_ssh' => 23]);
        $this->assertDatabaseHas('devices', ['port_telnet' => 24]);
        $this->assertDatabaseHas('devices', ['web_url' => 'http://127.0.0.1:8081']);
    }

    private function getDeviceData(): array
    {
        $deviceData['id']              = 1;
        $deviceData['title']           = '127.0.0.1';
        $deviceData['hostname']        = '127.0.0.1';
        $deviceData['vendor_id']       = 1;
        $deviceData['model_id']        = 1;
        $deviceData['firmware_id']     = 1;
        $deviceData['uptime']          = '00000000';
        $deviceData['contact']         = 'admin@test';
        $deviceData['location']        = 'DC Super 1';
        $deviceData['license_level']   = 1;
        $deviceData['serial_number']   = '00000000';
        $deviceData['packets_version'] = 1;
        $deviceData['platform_type']   = 1;
        $deviceData['enabled']         = 1;
        $deviceData['port']            = 161;
        $deviceData['community']       = 'public';
        $deviceData['version']         = 2;
        $deviceData['port_ssh']        = 22;
        $deviceData['port_telnet']     = 23;
        $deviceData['web_url']         = 'http://127.0.0.1:8080';

        return $deviceData;
    }

    private function getDeviceDataForUpdate(): array
    {
        $deviceData['title']           = '127.0.0.2';
        $deviceData['hostname']        = '127.0.0.2';
        $deviceData['vendor_id']       = 2;
        $deviceData['model_id']        = 2;
        $deviceData['firmware_id']     = 2;
        $deviceData['uptime']          = '11111111';
        $deviceData['contact']         = 'user@test';
        $deviceData['location']        = 'DC Super 2';
        $deviceData['license_level']   = 2;
        $deviceData['serial_number']   = '11111111';
        $deviceData['packets_version'] = 2;
        $deviceData['platform_type']   = 2;
        $deviceData['enabled']         = 0;
        $deviceData['port']            = 162;
        $deviceData['community']       = 'private';
        $deviceData['version']         = 3;
        $deviceData['port_ssh']        = 23;
        $deviceData['port_telnet']     = 24;
        $deviceData['web_url']         = 'http://127.0.0.1:8081';

        return $deviceData;
    }
}
