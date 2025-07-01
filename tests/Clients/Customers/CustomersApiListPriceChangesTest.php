<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Customers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\PriceChangesCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CustomersApiListPriceChangesTest extends TestCase
{
    public function test_list_price_changes(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'priceChanges' => [
                    include __DIR__ . '/../../Domain/data/customers/price_change.php',
                    include __DIR__ . '/../../Domain/data/customers/price_change.php',
                    include __DIR__ . '/../../Domain/data/customers/price_change.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/pricelist', $this)
        );

        $response = $sdk->customers->priceChangesList('johndoe');
        $this->assertInstanceOf(PriceChangesCollection::class, $response);
    }
}
