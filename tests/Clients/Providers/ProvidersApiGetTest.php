<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Providers;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Provider;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/provider_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/providers/REGISTRY/providername', $this)
        );

        $response = $sdk->providers->get('providername');
        $this->assertInstanceOf(Provider::class, $response);
    }
}
