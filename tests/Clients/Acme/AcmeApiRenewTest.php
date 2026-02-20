<?php declare(strict_types = 1);

namespace Clients\Acme;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiRenewTest extends TestCase
{
    public function test_renew(): void
    {
        $sdk = MockedClientFactory::makeMockedSdk(
            static function (): Response {
                return new Response(
                    202,
                    [
                        'x-process-id' => 10,
                    ]
                );
            },
            MockedClientFactory::assertRoute('POST', 'v2/ssl/acme/1/renew', $this)
        );

        $sdk->acme->renew(
            1,
            24,
        );
    }
}
