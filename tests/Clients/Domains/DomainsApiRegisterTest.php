<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\BillableCollection;
use RealtimeRegister\Domain\DomainContactCollection;
use RealtimeRegister\Domain\DomainQuote;
use RealtimeRegister\Domain\DomainRegistration;
use RealtimeRegister\Domain\KeyDataCollection;
use RealtimeRegister\Domain\Zone;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiRegisterTest extends TestCase
{
    public function test_register_quote(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domain_registration_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.nl', $this)
        );

        $registration = $sdk->domains->register(
            domainName: 'example.nl',
            customer: 'test',
            registrant: 'John Doe',
            isQuote: true
        );

        $this->assertInstanceOf(DomainQuote::class, $registration);
    }

    public function test_register(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domain_registration_valid.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com', $this)
        );

        $registration = $sdk->domains->register(
            'example.com',
            'test',
            'John Doe'
        );

        $this->assertInstanceOf(DomainRegistration::class, $registration);
    }

    public function test_register_with_details(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domain_registration_valid.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com', $this)
        );

        $registration = $sdk->domains->register(
            'example.com',
            'test',
            'John Doe',
            false,
            12,
            '123123123',
            'nl',
            true,
            [],
            false,
            null,
            Zone::fromArray(include __DIR__ . '/../../Domain/data/zone_valid.php'),
            DomainContactCollection::fromArray([include __DIR__ . '/../../Domain/data/domain_contact_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../../Domain/data/billable_valid.php'])
        );

        $this->assertInstanceOf(DomainRegistration::class, $registration);
    }
}
