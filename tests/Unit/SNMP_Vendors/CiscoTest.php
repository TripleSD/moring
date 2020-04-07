<?php

namespace Tests\Unit\SNMP_Vendors;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendors\Cisco;
use App\Repositories\Snmp\Vendors\Vendor;
use Tests\TestCase;

class CiscoTest extends TestCase
{
    public function testParseName(): void
    {
        $snmpObject          = new SnmpRepository();
        $snmpFlow            = $snmpObject->startSession($this->setVarsConnection());
        $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);

        $vendor = new Vendor();
        $this->assertEquals('Cisco', $vendor->parseName($vendorNameRawString));
    }

    public function testGetVendorClass(): void
    {
        $vendor = new Vendor();
        $this->assertInstanceOf(Cisco::class, $vendor->getVendorClass('Cisco'));
    }

    private function setVarsConnection()
    {
        $array['hostname']  = '127.0.0.1:9002';
        $array['community'] = 'public';
        $array['port']      = 161;

        return $array;
    }
}
