<?php declare(strict_types = 1);

return [
    'id' => 46069000,
    'user' => 'johndoe/died',
    'customer' => 'johndoe',
    'status' => 'FAILED',
    'resumeTypes' => [
        'MANUAL',
        'TIMER',
    ],
    'createdDate' => '2021-08-11T06:17:15Z',
    'updatedDate' => '2021-08-25T06:17:15Z',
    'startedDate' => '2021-08-11T06:17:15Z',
    'action' => 'update',
    'type' => 'contact',
    'identifier' => 'rtr-handle123',
    'reservation' => [
        'USD' => 1000000,
    ],
    'transaction' => [
        'USD' => 1000000,
    ],
    'refund' => [
        'USD' => 1000000,
    ],
    'command' => [
        'brand' => 'default',
        'city' => 'someplace',
        'country' => 'NL',
        'email' => 'fake@example.com',
        'fax' => '+31.101234567',
        'name' => 'department',
        'organization' => 'Realtime Register',
        'addressLine' => [
            'streetname 1',
        ],
        'postalCode' => '0000AA',
        'voice' => '+31.101234567',
    ],
    'billables' => [
        include __DIR__ . '/../financial/billable_valid.php',
        include __DIR__ . '/../financial/billable_valid.php',
    ],
];
