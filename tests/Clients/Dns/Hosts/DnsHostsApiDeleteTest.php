<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Hosts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsHostsApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', 'v2/hosts/ns1.example.com', $this)
        );

        $sdk->hosts->delete('ns1.example.com');
    }
}
