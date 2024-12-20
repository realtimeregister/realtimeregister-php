<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Customers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\PriceCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CustomersApiListPricesTest extends TestCase
{
    public function test_list_prices(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'prices' => [
                    include __DIR__ . '/../../Domain/data/price_valid.php',
                    include __DIR__ . '/../../Domain/data/price_valid.php',
                    include __DIR__ . '/../../Domain/data/price_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/pricelist', $this)
        );

        $response = $sdk->customers->priceList('johndoe');
        $this->assertInstanceOf(PriceCollection::class, $response);
    }
}
