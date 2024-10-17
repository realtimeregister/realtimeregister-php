<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Customers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Account;
use RealtimeRegister\Domain\AccountCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CustomersApiCreditsTest extends TestCase
{
    public function test_credits(): void
    {
        $primary = include __DIR__ . '/../../Domain/data/account_valid.php';
        $primary['primary'] = true;

        $secondary = include __DIR__ . '/../../Domain/data/account_valid.php';
        $secondary['primary'] = false;
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(
                [
                'accounts' => [
                        $primary,
                        $secondary,
                        $secondary,
                    ],
                ]
            ),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/credit', $this)
        );

        $response = $sdk->customers->credits('johndoe');
        $this->assertInstanceOf(AccountCollection::class, $response);
        $this->assertInstanceOf(Account::class, $response->entities[0]);
        $this->assertCount(3, $response->entities);
    }
}
