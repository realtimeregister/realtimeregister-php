<?php

namespace Clients\Acme;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiDeleteTest extends TestCase
{
    public function test_delete(): void
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
            MockedClientFactory::assertRoute('DELETE', 'v2/ssl/acme/1', $this)
        );

        $sdk->acme->delete(
            1,
        );
    }
}
