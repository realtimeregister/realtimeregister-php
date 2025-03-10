<?php

declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Zones;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiRetrieveTest extends TestCase
{
    public function test_retrieve(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', "v2/dns/zones/{$zoneId}/retrieve", $this)
        );

        $sdk->dnszones->retrieve($zoneId);
    }
}
