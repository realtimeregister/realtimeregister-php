<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php'),
            MockedClientFactory::assertRoute('DELETE', 'v2/domains/example.com', $this)
        );

        $sdk->domains->delete('example.com');
    }
}
