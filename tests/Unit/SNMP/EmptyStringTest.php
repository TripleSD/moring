<?php

namespace Tests\Unit\SNMP;

use Tests\TestCase;
use App\Repositories\Snmp\ParseVendor;

class EmptyStringTest extends TestCase
{
    public function testGetVendor(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new ParseVendor();
        $this->assertEquals(null, $vendor->getName($snmpWalk));
    }

    private function getMockSnmpWalk(): array
    {
        return [];
    }
}
