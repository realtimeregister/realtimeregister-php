<?php declare(strict_types = 1);

return [
    'customer' => 'johndoe',
    'handle' => 'jdoe',
    'brand' => 'realtimeregister',
    'name' => 'John Doe',
    'addressLine' => [
        'Edisonweg 51D',
    ],
    'postalCode' => '4382NV',
    'city' => 'Flushing',
    'state' => 'Zeeland',
    'country' => 'Netherlands',
    'email' => 'test@example.com',
    'voice' => '(350) 507-3602',
    'fax' => '+1-212-9876543',
    'registries' => [
        'IisSe',
        'Sidn',
    ],
    'properties' => [
        'sidn' => [
            'is_verified' => 'true',
        ],
    ],
    'createdDate' => '2020-08-30T01:02:03Z',
    'updatedDate' => '2020-08-30T01:02:03Z',
    'validations' => [
        [
            'validatedOn'=> '2025-01-06T15:25:25Z',
            'version' => 1,
            'category' => 'General',
        ],
        [
            'validatedOn'=> '2025-01-06T15:25:25Z',
            'version' => 5,
            'category' => 'IisSe',
        ],
    ],
    'disclosedFields' => [
        \RealtimeRegister\Domain\Enum\DisclosedField::DISCLOSED_FIELD_REGISTY_CITY,
        \RealtimeRegister\Domain\Enum\DisclosedField::DISCLOSED_FIELD_REGISTY_ADDRESS_LINE,
    ],
];
