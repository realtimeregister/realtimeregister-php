<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class RenewOnTransferEnum extends AbstractEnum
{
    const NO_CHANGE = 'NO_CHANGE';
    const RENEW_UNLESS_GRACE = 'RENEW_UNLESS_GRACE';
    const RENEWAL = 'RENEWAL';
    const NEW_PERIOD = 'NEW_PERIOD';

    protected static array $values = [
        RenewOnTransferEnum::NO_CHANGE,
        RenewOnTransferEnum::RENEW_UNLESS_GRACE,
        RenewOnTransferEnum::RENEWAL,
        RenewOnTransferEnum::NEW_PERIOD,
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
