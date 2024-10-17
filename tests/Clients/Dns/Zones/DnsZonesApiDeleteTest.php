<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Zones;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', 'v2/dns/zones/1111111111', $this)
        );
        $sdk->dnszones->delete(1111111111);
    }
}
