<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Hosts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsHostsApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../../Domain/data/dns/hosts/hosts.php',
                ],
                'pagination' => [
                    'total'  => 1,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/hosts', $this)
        );

        $result = $sdk->hosts->list(
            null,
            null,
            'ns1.example.com',
        );
    }
}
