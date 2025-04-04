<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Hosts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\DnsHostAddressCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsHostsApiUpdateTest extends TestCase
{
    public function test_empty_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/hosts/ns1.example.com/update', $this)
        );

        $sdk->hosts->update(
            'ns1.example.com',
            null
        );
    }

    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/hosts/ns1.example.com/update', $this)
        );

        $sdk->hosts->update(
            'ns1.example.com',
            DnsHostAddressCollection::fromArray(
                [
                    [
                        'ipVersion' => 'V4',
                        'address' => '127.0.0.1',
                    ],
                    [
                        'ipVersion' => 'V6',
                        'address' => '::1',
                    ],
                ]
            )
        );
    }
}
