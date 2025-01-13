<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\DomainDetailsCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/domains', $this)
        );

        $response = $sdk->domains->list();
        $this->assertInstanceOf(DomainDetailsCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/domains', $this)
        );

        $response = $sdk->domains->list(3, 0, 'john');
        $this->assertInstanceOf(DomainDetailsCollection::class, $response);
    }

    public function test_list_incorrect_query(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('GET', 'v2/domains', $this)
        );
        $this->expectException(\InvalidArgumentException::class);
        $sdk->domains->list(3, 0, 'john', ['export' => true, 'fields' => ['domain']]);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'registrant' => 'testregistrant',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                    include __DIR__ . '/../../Domain/data/domains/domain_details_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/domains', $this, [
                'registrant' => 'testregistrant',
                'limit' => '3',
                'offset' => '0',
                'q' => 'john',
            ])
        );

        $response = $sdk->domains->list(3, 0, 'john', $parameters);
        $this->assertInstanceOf(DomainDetailsCollection::class, $response);
    }
}
