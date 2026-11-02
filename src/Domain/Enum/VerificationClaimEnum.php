<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class VerificationClaimEnum extends AbstractEnum
{
    const EMAIL = 'EMAIL';
    const ADDRESS = 'ADDRESS';
    const ORGANIZATION = 'ORGANIZATION';
    const NAME = 'NAME';
    const VOICE = 'VOICE';

    protected static array $values = [
        self::EMAIL,
        self::ADDRESS,
        self::ORGANIZATION,
        self::NAME,
        self::VOICE,
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
