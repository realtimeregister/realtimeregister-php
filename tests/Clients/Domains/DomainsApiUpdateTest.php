<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\BillableCollection;
use RealtimeRegister\Domain\DomainContactCollection;
use RealtimeRegister\Domain\DomainQuote;
use RealtimeRegister\Domain\Enum\BillableActionEnum;
use RealtimeRegister\Domain\KeyDataCollection;
use RealtimeRegister\Domain\Zone;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiUpdateTest extends TestCase
{
    public function test_transfer_quote(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domains/domain_update_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/update', $this)
        );

        $response = $sdk->domains->update(
            domainName: 'example.com',
            registrant: 'John Doe',
            privacyProtect: false,
            period: 12,
            authcode: '123123123',
            languageCode: 'nl',
            autoRenew: true,
            ns: [],
            statuses: ['OK'],
            designatedAgent: 'OLD',
            zone: Zone::fromArray(include __DIR__ . '/../../Domain/data/dns/zones/zone_valid.php'),
            contacts: DomainContactCollection::fromArray([include __DIR__ . '/../../Domain/data/contacts/contact_handle_valid.php']),
            keyData: KeyDataCollection::fromArray([include __DIR__ . '/../../Domain/data/key_data_valid.php']),
            billables: BillableCollection::fromArray([include __DIR__ . '/../../Domain/data/financial/billable_valid.php']),
            isQuote: true,
        );

        $this->assertInstanceOf(DomainQuote::class, $response);
        $this->assertSame(BillableActionEnum::ACTION_UPDATE, $response->quote->billables[0]->action);
    }

    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/update', $this)
        );

        $sdk->domains->update(
            'example.com',
            'John Doe',
            false,
            12,
            '123123123',
            'nl',
            true,
            [],
            ['OK'],
            'OLD',
            Zone::fromArray(include __DIR__ . '/../../Domain/data/dns/zones/zone_valid.php'),
            DomainContactCollection::fromArray([include __DIR__ . '/../../Domain/data/contacts/contact_handle_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../../Domain/data/financial/billable_valid.php'])
        );
    }

    public function test_update_empty_fields(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/update', $this, expectedFields: [
                'authcode' => '',
                'ns' => [],
                'keyData' => [],
            ])
        );

        $sdk->domains->update(
            domainName: 'example.com',
            authcode: '',
            ns: [],
            keyData: KeyDataCollection::fromArray([])
        );
    }

    public function test_free_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domains/domain_free_update_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/update', $this)
        );

        $response = $sdk->domains->update(
            domainName: 'example.com',
            isQuote: true
        );

        $this->assertInstanceOf(DomainQuote::class, $response);
        $this->assertNull($response->quote->currency);
        $this->assertNull($response->quote->billables);
    }
}
