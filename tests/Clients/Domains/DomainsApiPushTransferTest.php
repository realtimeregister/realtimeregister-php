<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Domains;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiPushTransferTest extends TestCase
{
    public function test_push_transfer(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/transfer/push', $this)
        );

        $sdk->domains->pushTransfer('example.com', 'testtest');
    }
}
