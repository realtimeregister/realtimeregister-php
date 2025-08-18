<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\DomainZoneRecord;
use RealtimeRegister\Domain\DomainZoneRecordCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiZoneTest extends TestCase
{
    public function test_zone(): void
    {
        $validDomainZoneDetails = include __DIR__ . '/../../Domain/data/domains/domain_zone_details.php';
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode($validDomainZoneDetails),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/zone', $this)
        );

        $response = $sdk->domains->zone('example.com');

        $this->assertSame($validDomainZoneDetails, $response->toArray());
        $this->assertInstanceOf(DomainZoneRecordCollection::class, $response->records);
        $this->assertInstanceOf(DomainZoneRecord::class, $response->records[0]);
    }
}
