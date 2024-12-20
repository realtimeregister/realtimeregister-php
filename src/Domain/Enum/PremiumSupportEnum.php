<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class PremiumSupportEnum extends AbstractEnum
{
    const NO = 'NO';
    const REGULAR = 'REGULAR';
    const CREATE_ONLY = 'CREATE_ONLY';

    protected static array $values = [
        self::NO,
        self::REGULAR,
        self::CREATE_ONLY,
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
