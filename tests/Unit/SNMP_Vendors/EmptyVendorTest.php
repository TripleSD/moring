<?php

namespace Tests\Unit\SNMP_Vendors;

use App\Repositories\Snmp\SnmpRepository;
use App\Repositories\Snmp\Vendor;
use Tests\TestCase;

class EmptyVendorTest extends TestCase
{
    public function testParseName(): void
    {
        $snmpObject          = new SnmpRepository();
        $snmpFlow            = $snmpObject->startSession($this->setVarsConnection());
        $vendorNameRawString = $snmpObject->getVendorNameRawString($snmpFlow);

        $vendor = new Vendor();
        $this->assertEquals(null, $vendor->parseName($vendorNameRawString));
    }

    private function setVarsConnection()
    {
        $array['hostname']  = '127.0.0.1:9006';
        $array['community'] = 'public';
        $array['port']      = 161;

        return $array;
    }
}
