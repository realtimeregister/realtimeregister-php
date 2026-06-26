<?php declare(strict_types = 1);

return [
    'name' => 'General',
    'description' => 'General',
    'fields' => [
        'organization',
        'name',
        'email',
    ],
    'terms' => [
        [
            'terms' => 'https://example.com/terms-and-conditions',
            'version' => 1,
        ],
    ],
];
