<?php

namespace RealtimeRegister\Domain\Enum;

class AcmeSubscriptionStatusEnum extends AbstractEnum
{
    const ACTIVE = 'ACTIVE';
    const SUSPENDED = 'SUSPENDED';
    const REVOKED = 'REVOKED';
    const PENDING_ORGANIZATION_VALIDATION = 'PENDING_ORGANIZATION_VALIDATION';

    protected static array $values = [
        AcmeSubscriptionStatusEnum::ACTIVE,
        AcmeSubscriptionStatusEnum::SUSPENDED,
        AcmeSubscriptionStatusEnum::REVOKED,
        AcmeSubscriptionStatusEnum::PENDING_ORGANIZATION_VALIDATION
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
