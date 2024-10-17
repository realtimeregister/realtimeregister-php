<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Templates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\DomainZoneRecordCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsTemplatesApiUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/dnstemplates/test/update', $this)
        );

        $sdk->dnstemplates->update(
            'johndoe',
            'test',
            'john.doe@example.com',
            123,
            456,
            789,
            777,
            DomainZoneRecordCollection::fromArray(
                [
                    [
                        'name'    => '##DOMAIN##',
                        'type'    => 'URL',
                        'content' => 'http://www.donaldduck.nl/',
                        'ttl'     => 300,
                    ],
                    [
                        'name' => 'www.##DOMAIN##',
                        'type' => 'A',
                        'content' => '1.1.1.1',
                        'ttl' => 300,
                    ],
                ]
            )
        );
    }
}
