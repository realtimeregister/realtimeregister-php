<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class LocaleEnum extends AbstractEnum
{
    const LOCALE_EN_US = 'en-US';
    const LOCALE_NL_NL = 'nl-NL';
    const LOCALE_KO_KR = 'ko-KR';
    const LOCALE_TR_TR = 'tr-TR';
    const LOCALE_IT_IT = 'it-IT';
    const LOCALE_FR_FR = 'fr-FR';
    const LOCALE_UK_UA = 'uk-UA';
    const LOCALE_DA_DK = 'da-DK';
    const LOCALE_ES_ES = 'es-ES';
    const LOCALE_PT_PT = 'pt-PT';
    const LOCALE_DE_DE = 'de-DE';
    const LOCALE_FI_FI = 'fi-FI';
    const LOCALE_ET_ET = 'et-ET';
    const LOCALE_RU_RU = 'ru-RU';
    const LOCALE_SV_SE = 'sv-SE';

    protected static array $values = [
        LocaleEnum::LOCALE_EN_US,
        LocaleEnum::LOCALE_NL_NL,
        LocaleEnum::LOCALE_KO_KR,
        LocaleEnum::LOCALE_TR_TR,
        LocaleEnum::LOCALE_IT_IT,
        LocaleEnum::LOCALE_FR_FR,
        LocaleEnum::LOCALE_UK_UA,
        LocaleEnum::LOCALE_DA_DK,
        LocaleEnum::LOCALE_ES_ES,
        LocaleEnum::LOCALE_PT_PT,
        LocaleEnum::LOCALE_DE_DE,
        LocaleEnum::LOCALE_FI_FI,
        LocaleEnum::LOCALE_ET_ET,
        LocaleEnum::LOCALE_RU_RU,
        LocaleEnum::LOCALE_SV_SE,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        LocaleEnum::assertValueValid($value);
    }
}
