<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use DateTime;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\BillableCollection;
use RealtimeRegister\Domain\DomainQuote;
use RealtimeRegister\Domain\Enum\BillableActionEnum;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiRenewTest extends TestCase
{
    public function test_renew_quote(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domains/domain_renew_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/renew', $this)
        );

        $response = $sdk->domains->renew(
            domain: 'example.com',
            period: 12,
            billables: BillableCollection::fromArray([
                include __DIR__ . '/../../Domain/data/financial/billable_valid.php',
                include __DIR__ . '/../../Domain/data/financial/billable_valid.php',
            ]),
            isQuote: true
        );

        $this->assertInstanceOf(DomainQuote::class, $response);
        $this->assertSame(BillableActionEnum::ACTION_RENEW, $response->quote->billables[0]->action);
    }

    public function test_renew(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(['expiryDate' => '2020-03-04 12:34:56']),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/renew', $this)
        );

        $expiry = $sdk->domains->renew('example.com', 12, BillableCollection::fromArray([
            include __DIR__ . '/../../Domain/data/financial/billable_valid.php',
            include __DIR__ . '/../../Domain/data/financial/billable_valid.php',
        ]));

        $this->assertInstanceOf(DateTime::class, $expiry);
        $this->assertSame('2020-03-04 12:34:56', $expiry->format('Y-m-d H:i:s'));
    }
}
