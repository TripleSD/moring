<?php

namespace Tests\Unit\SNMP_Vendors;

use App\Repositories\Snmp\Vendor;
use App\Repositories\Snmp\Vendors\DLink;
use App\Repositories\Snmp\SnmpRepository;
use Tests\TestCase;

class DLinkTest extends TestCase
{
    public function testParseName(): void
    {
        $snmpObject          = new SnmpRepository();
        $snmpFlow            = $snmpObject->startSession($this->setVarsConnection());
        $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);

        $vendor = new Vendor();
        $this->assertEquals('DLink', $vendor->parseName($vendorNameRawString));
    }

    public function testGetVendorClass(): void
    {
        $class = new DLink();
        $this->assertEquals($class, (new Vendor())->getVendorClass('DLink'));
    }

    private function setVarsConnection()
    {
        $array['hostname']      = '127.0.0.1:9003';
        $array['snmpCommunity'] = 'public';

        return $array;
    }
}
