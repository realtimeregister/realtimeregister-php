<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class VerificationProofEnum extends AbstractEnum
{
    const LOG_RECORD = 'LOG_RECORD';
    const ID_CARD = 'ID_CARD';
    const PASSPORT = 'PASSPORT';
    const POPULATION_REGISTER = 'POPULATION_REGISTER';
    const RESIDENCE_PERMIT = 'RESIDENCE_PERMIT';
    const DRIVERS_LICENCE = 'DRIVERS_LICENCE';
    const COMPANY_REGISTER = 'COMPANY_REGISTER';
    const COMPANY_STATEMENT = 'COMPANY_STATEMENT';
    const BANK_ACCOUNT = 'BANK_ACCOUNT';
    const ONLINE_PAYMENT_ACCOUNT = 'ONLINE_PAYMENT_ACCOUNT';
    const UTILITY_ACCOUNT = 'UTILITY_ACCOUNT';
    const BANK_STATEMENT = 'BANK_STATEMENT';
    const TAX_STATEMENT = 'TAX_STATEMENT';
    const ADDRESS_DATABASE = 'ADDRESS_DATABASE';

    protected static array $values = [
        self::LOG_RECORD,
        self::ID_CARD,
        self::PASSPORT,
        self::POPULATION_REGISTER,
        self::RESIDENCE_PERMIT,
        self::DRIVERS_LICENCE,
        self::COMPANY_REGISTER,
        self::COMPANY_STATEMENT,
        self::BANK_ACCOUNT,
        self::ONLINE_PAYMENT_ACCOUNT,
        self::UTILITY_ACCOUNT,
        self::BANK_STATEMENT,
        self::TAX_STATEMENT,
        self::ADDRESS_DATABASE,
    ];

    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
