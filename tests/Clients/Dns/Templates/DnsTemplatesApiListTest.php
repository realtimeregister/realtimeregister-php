<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Templates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsTemplatesApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_without_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/dnstemplates', $this)
        );

        $response = $sdk->dnstemplates->list('johndoe');
        $this->assertSame(3, $response->count());
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_without_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute(
                'GET',
                'v2/customers/johndoe/dnstemplates',
                $this,
                ['limit'=>'3', 'offset'=>'0', 'q'=>'john']
            )
        );

        $response = $sdk->dnstemplates->list('johndoe', 3, 0, 'john');
        $this->assertSame(3, $response->count());
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'name' => 'test',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_without_records.php',
                    include __DIR__ . '/../../../Domain/data/dns/templates/dnstemplate_valid_with_records.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/dnstemplates', $this, [
                'name' => 'test',
                'limit' => '3',
                'offset' => '0',
                'q' => 'john',
            ])
        );

        $response = $sdk->dnstemplates->list('johndoe', 3, 0, 'john', $parameters);
        $this->assertSame(3, $response->count());
    }
}
