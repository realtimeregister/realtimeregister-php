<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class VerificationMethodEnum extends AbstractEnum
{
    const REACHABILITY = 'REACHABILITY';
    const ELECTRONIC_DOCUMENT = 'ELECTRONIC_DOCUMENT';
    const PHYSICAL_DOCUMENT = 'PHYSICAL_DOCUMENT';
    const EID_AUTH = 'EID_AUTH';
    const TRANSACTION = 'TRANSACTION';
    const DATA = 'DATA';

    protected static array $values = [
        self::REACHABILITY,
        self::ELECTRONIC_DOCUMENT,
        self::PHYSICAL_DOCUMENT,
        self::EID_AUTH,
        self::TRANSACTION,
        self::DATA,
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
