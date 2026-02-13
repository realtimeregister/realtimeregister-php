<?php

namespace Clients\Acme;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Approver;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiUpdateTest extends TestCase
{
    public function test_update() {
        $sdk = MockedClientFactory::makeMockedSdk(
            static function (): Response {
                return new Response(
                    202,
                    [
                        'x-process-id' => 20,
                    ]
                );
            },
            MockedClientFactory::assertRoute('POST', 'v2/ssl/acme/1/update', $this)
        );

        $sdk->acme->update(
            1,
            12,
            ['example3.com'],
            'org',
            'NL',
            'State',
            'Address Line',
            'postalCode',
            'City',
            false,
            Approver::fromArray(
                ['firstName' => 'First Name',
                    'lastName' => 'Last Name',
                    'jobTitle' => 'Engineer',
                    'email' => 'test@example.com',
                    'voice' => '+31.6123123213']
            ),
            false
        );
    }
}
