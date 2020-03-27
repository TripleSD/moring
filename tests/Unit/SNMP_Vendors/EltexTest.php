<?php

namespace Tests\Unit\SNMP_Vendors;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendor;
use App\Repositories\Snmp\Vendors\Eltex;
use Tests\TestCase;

class EltexTest extends TestCase
{
    public function testParseName(): void
    {
        $snmpObject          = new SnmpRepository();
        $snmpFlow            = $snmpObject->startSession($this->setVarsConnection());
        $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);

        $vendor = new Vendor();
        $this->assertEquals('Eltex', $vendor->parseName($vendorNameRawString));
    }

    public function testGetVendorClass(): void
    {
        $class = new Eltex();
        $this->assertEquals($class, (new Vendor())->getVendorClass('Eltex'));
    }

    private function setVarsConnection()
    {
        $array['hostname']  = '127.0.0.1:9004';
        $array['community'] = 'public';
        $array['port']      = 161;

        return $array;
    }
}
