<?php
declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Financial;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\ExchangeRates;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class FinancialApiExchangeRatesTest extends TestCase
{
    public function test_exchangerates(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../../Domain/data/exchangerates_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/exchangerates/EUR', $this)
        );

        $response = $sdk->financial->exchangeRates('EUR');
        $this->assertInstanceOf(ExchangeRates::class, $response);
    }
}
