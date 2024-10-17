<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\DomainAvailability;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiCheckTest extends TestCase
{
    public function test_check(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domain_availability_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/check', $this)
        );

        $response = $sdk->domains->check('example.com');
        $this->assertInstanceOf(DomainAvailability::class, $response);
    }

    public function test_check_with_languageCode(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/domain_availability_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/check', $this)
        );

        $response = $sdk->domains->check('example.com', 'nl');
        $this->assertInstanceOf(DomainAvailability::class, $response);
    }
}
