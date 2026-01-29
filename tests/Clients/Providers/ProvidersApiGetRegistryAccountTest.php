<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Providers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\RegistryAccount;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiGetRegistryAccountTest extends TestCase
{
    public function test_get_registry_account(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/registryAccounts/registry_account_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/registryAccounts/testRegistry/test', $this)
        );

        $response = $sdk->providers->getRegistryAccount('testRegistry', 'test');
        $this->assertInstanceOf(RegistryAccount::class, $response);
    }
}
