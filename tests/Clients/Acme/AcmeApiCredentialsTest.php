<?php declare(strict_types = 1);

namespace Clients\Acme;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiCredentialsTest extends TestCase
{
    public function test_credentials()
    {
        $response = [
            'directoryUrl' => 'example.directory',
            'accountKey' => 'TESTKEY123',
            'hmacKey' => 'TESTHMACKEY123',
        ];
        $sdk = MockedClientFactory::makeMockedSdk(
            static function () use ($response): Response {
                return new Response(
                    202,
                    [
                        'x-process-id' => 20,
                    ],
                    json_encode($response, JSON_THROW_ON_ERROR),
                );
            },
            MockedClientFactory::assertRoute('POST', 'v2/ssl/acme/1/credentials', $this)
        );

        $result = $sdk->acme->credentials(1);

        self::assertSame($response, $result->toArray());
    }
}
