<?php declare(strict_types=1);

namespace RealtimeRegister\Domain\Enum;

class CertificateTypeEnum extends AbstractEnum
{
    const SINGLE_DOMAIN = 'SINGLE_DOMAIN';
    const MULTI_DOMAIN = 'MULTI_DOMAIN';
    const WILDCARD = 'WILDCARD';
    const ACME_SUBSCRIPTION = 'ACME_SUBSCRIPTION';

    protected static array $values = [
        CertificateTypeEnum::SINGLE_DOMAIN,
        CertificateTypeEnum::MULTI_DOMAIN,
        CertificateTypeEnum::WILDCARD,
        CertificateTypeEnum::ACME_SUBSCRIPTION
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        CertificateTypeEnum::assertValueValid($value);
    }
}
