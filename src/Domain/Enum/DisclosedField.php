<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class DisclosedField extends AbstractEnum
{
    const DISCLOSED_FIELD_REGISTY_REGISTRY_CONTACT_ID = 'registryContactId';
    const DISCLOSED_FIELD_REGISTY_EMAIL = 'email';
    const DISCLOSED_FIELD_REGISTY_NAME = 'templateName';
    const DISCLOSED_FIELD_REGISTY_ORGANIZATION = 'organization';
    const DISCLOSED_FIELD_REGISTY_ADDRESS_LINE = 'addressLine';
    const DISCLOSED_FIELD_REGISTY_CITY = 'city';
    const DISCLOSED_FIELD_REGISTY_POSTAL_CODE = 'postalCode';
    const DISCLOSED_FIELD_REGISTY_VOICE = 'voice';
    const DISCLOSED_FIELD_REGISTY_FAX = 'fax';

    protected static array $values = [
        DisclosedField::DISCLOSED_FIELD_REGISTY_REGISTRY_CONTACT_ID,
        DisclosedField::DISCLOSED_FIELD_REGISTY_EMAIL,
        DisclosedField::DISCLOSED_FIELD_REGISTY_NAME,
        DisclosedField::DISCLOSED_FIELD_REGISTY_ORGANIZATION,
        DisclosedField::DISCLOSED_FIELD_REGISTY_ADDRESS_LINE,
        DisclosedField::DISCLOSED_FIELD_REGISTY_CITY,
        DisclosedField::DISCLOSED_FIELD_REGISTY_POSTAL_CODE,
        DisclosedField::DISCLOSED_FIELD_REGISTY_VOICE,
        DisclosedField::DISCLOSED_FIELD_REGISTY_FAX,
    ];

    public static function validate($value): void
    {
        DisclosedField::assertValueValid($value);
    }
}
