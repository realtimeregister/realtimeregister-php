<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class ValidationCategoryEnum extends AbstractEnum
{
    const VALIDATION_CATEGORY_GENERAL = 'General';
    const VALIDATION_CATEGORY_IIS_NU = 'IisNu';
    const VALIDATION_CATEGORY_IIS_SE = 'IisSe';
    const VALIDATION_CATEGORY_NOMINET = 'Nominet';

    protected static array $values = [
        ValidationCategoryEnum::VALIDATION_CATEGORY_GENERAL,
        ValidationCategoryEnum::VALIDATION_CATEGORY_IIS_NU,
        ValidationCategoryEnum::VALIDATION_CATEGORY_IIS_SE,
        ValidationCategoryEnum::VALIDATION_CATEGORY_NOMINET,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        ValidationCategoryEnum::assertValueValid($value);
    }
}
