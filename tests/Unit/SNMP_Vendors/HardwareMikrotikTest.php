<?php

namespace Tests\Unit\SNMP_Vendors;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Mikrotik;
use App\Repositories\Snmp\Vendors\Vendor;
use Tests\TestCase;

class HardwareMikrotikTest extends TestCase
{
    public function testParseName(): void
    {
        $snmpObject          = new SnmpRepository();
        $snmpFlow            = $snmpObject->startSession($this->setVarsConnection());
        $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);

        $vendor = new Vendor();
        $this->assertEquals('Mikrotik', $vendor->parseName($vendorNameRawString));
    }

    public function testGetVendorClass(): void
    {
        $class = new Mikrotik();
        $this->assertEquals($class, (new Vendor())->getVendorClass('Mikrotik'));
    }

    private function setVarsConnection()
    {
        $array['hostname']  = '127.0.0.1:9005';
        $array['community'] = 'public';
        $array['port']      = 161;

        return $array;
    }
}
