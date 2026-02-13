<?php

namespace Clients\Acme;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\AcmeSubscriptionResponse;
use RealtimeRegister\Domain\Approver;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiCreateTest extends TestCase
{

    public function test_create()
    {
        $response = [
            'id' => 1,
            'directoryUrl' => 'example.directory',
            'accountKey' => 'TESTKEY123',
            'hmacKey' => 'TESTHMACKEY123'
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
            MockedClientFactory::assertRoute('POST', 'v2/ssl/acme', $this)
        );

        $result = $sdk->acme->create(
            'customer',
            'acme',
            12,
            ['example.com', 'example2.com'],
            'Example Org',
            'NL',
            'State',
            'Address Line 1',
            '1234AB',
            'City',
            true,
            199,
            Approver::fromArray(
                ['firstName' => 'First Name',
                    'lastName' => 'Last Name',
                    'jobTitle' => 'Engineer',
                    'email' => 'test@example.com',
                    'voice' => '+31.6123123213']
            )
        );

        self::assertInstanceOf(AcmeSubscriptionResponse::class, $result);
        self::assertSame($result->toArray(), $response);
    }
}
