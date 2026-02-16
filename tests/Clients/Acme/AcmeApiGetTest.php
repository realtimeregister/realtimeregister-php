<?php declare(strict_types = 1);

namespace Clients\Acme;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Enum\AcmeSubscriptionStatusEnum;
use RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use RealtimeRegister\Domain\Enum\ValidationTypeEnum;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class AcmeApiGetTest extends TestCase
{
    public function test_get()
    {
        $startDate = new DateTimeImmutable();
        $expiryDate = new DateTimeImmutable('+1 year');

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
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
                'createdDate' => $startDate->format('Y-m-d H:i:s'),
                'expiryDate' => $expiryDate->format('Y-m-d H:i:s'),
                'status' => AcmeSubscriptionStatusEnum::ACTIVE,
                'period' => 12,
                'directoryUrl' => 'example.directory',
                'autoRenew' => false,
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/ssl/acme/1', $this)
        );

        $acmeSubscription = $sdk->acme->get(1);

        self::assertSame(1, $acmeSubscription->id);
        self::assertSame('ssl', $acmeSubscription->product);
        self::assertSame(['example.com', 'example2.com'], $acmeSubscription->domainNames);
        self::assertSame('Example', $acmeSubscription->organization);
        self::assertSame('Address Line', $acmeSubscription->address);
        self::assertSame('Amsterdam', $acmeSubscription->city);
        self::assertSame('Noord-Holland', $acmeSubscription->state);
        self::assertSame('1234AB', $acmeSubscription->postalCode);
        self::assertSame('The Netherlands', $acmeSubscription->country);
        self::assertSame($startDate->getTimestamp(), $acmeSubscription->createdDate->getTimestamp());
        self::assertSame($expiryDate->getTimestamp(), $acmeSubscription->expiryDate->getTimestamp());
        self::assertSame(AcmeSubscriptionStatusEnum::ACTIVE, $acmeSubscription->status);
    }
}
