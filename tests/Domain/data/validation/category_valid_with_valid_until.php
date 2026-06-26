<?php declare(strict_types = 1);

return [
    'name' => 'IisNu',
    'description' => 'IisNu validation category',
    'fields' => [
        'organization',
        'name',
    ],
    'terms' => [
        [
            'terms' => 'https://example.com/iisnu-terms-v5.pdf',
            'version' => 5,
        ],
        [
            'terms' => 'https://example.com/iisnu-terms-v4.pdf',
            'validUntil' => '2026-01-15T00:00:00Z',
            'version' => 4,
        ],
    ],
];
