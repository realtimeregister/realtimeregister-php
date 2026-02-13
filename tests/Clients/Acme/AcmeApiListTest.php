<?php

namespace Clients\Acme;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\AcmeSubscription;
use RealtimeRegister\Domain\Enum\AcmeSubscriptionStatusEnum;
use RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use RealtimeRegister\Domain\Enum\ValidationTypeEnum;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiListTest extends TestCase {

    public function test_list() {
        $createdDate = new DateTimeImmutable();
        $expiryDate = new DateTimeImmutable('+1 year');

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    [
                        'id' => 1,
                        'product' => 'ssl',
                        'validationType' => ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
                        'certificateType' => CertificateTypeEnum::ACME_SUBSCRIPTION,
                        'domainNames' => ['example.com', 'example2.com'],
                        'organization' => 'Example',
                        'address' => 'Address Line',
                        'city' => 'Amsterdam',
                        'state' => 'Noord-Holland',
                        'postalCode' => '1234AB',
                        'country' => 'The Netherlands',
                        'createdDate' => $createdDate->format('Y-m-d H:i:s'),
                        'expiryDate' => $expiryDate->format('Y-m-d H:i:s'),
                        'status' => AcmeSubscriptionStatusEnum::ACTIVE,
                        'period' => 12,
                        'directoryUrl' => 'example.directory',
                        'autoRenew' => false
                    ]
                ],
                'pagination' => [
                    'total' => 1,
                    'offset' => 0,
                    'limit' => 5,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/ssl/acme', $this, [
                'limit' => '5',
                'offset' => '0'
            ])
        );

        $subscriptions = $sdk->acme->list(5, 0);
        self::assertInstanceOf(AcmeSubscription::class, $subscriptions[0]);
    }
}
