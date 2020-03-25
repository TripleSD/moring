<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Mikrotik;
use Tests\TestCase;

class CloudMikrotikExceptionTest extends TestCase
{
    public function testGetSerialNumber(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());
        $vendor         = new Mikrotik();
        $this->assertEquals(null, $vendor->getSerialNumber($snmpConnection));
    }

    public function testGetFirmwareVersion(): void
    {
        $snmpConnection = (new SnmpRepository())->startSession($this->setVarsConnection());
        $vendor         = new Mikrotik();
        $this->assertEquals(null, $vendor->getFirmwareVersion($snmpConnection));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '0.0.0.0';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
