<?php

namespace Tests\Unit\SNMP;

use App\Repositories\Snmp\ParseVendor;
use Tests\TestCase;

class MikrotikTest extends TestCase
{
    public function testGetVendor(): void
    {
        $snmpWalk = $this->getMockSnmpWalk();
        $vendor   = new ParseVendor();
        $this->assertEquals('Mikrotik', $vendor->getName($snmpWalk));
    }

    private function getMockSnmpWalk(): array
    {
        $array    = [];
        $mockFile = fopen(__DIR__ . "/Mocks/Mikrotik/CHR.src", "r");
        while (! feof($mockFile)) {
            $line = fgets($mockFile);
            $line = explode('=', $line);

            if (empty($line[1])) {
                $array[$line[0]] = '';
            } else {
                $array[preg_replace('/ /', '', $line[0])] = $line[1];
            }
        }
        fclose($mockFile);

        return $array;
    }
}
