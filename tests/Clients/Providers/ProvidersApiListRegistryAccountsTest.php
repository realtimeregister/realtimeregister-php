<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Providers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\RegistryAccountCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiListRegistryAccountsTest extends TestCase
{
    public function test_list_registry_accounts(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                include __DIR__ . '/../../Domain/data/registryAccounts/registry_account_valid.php',
            ],
            'pagination' => [
                'total'  => 1,
                'offset' => 0,
                'limit'  => 10,
            ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/registryAccounts', $this)
        );

        $response = $sdk->providers->listRegistryAccounts();
        $this->assertInstanceOf(RegistryAccountCollection::class, $response);
    }
}
