<?php declare(strict_types = 1);

use RealtimeRegister\Domain\Enum\EventTypeEnum;
use RealtimeRegister\Domain\Enum\NotificationTypeEnum;

return [
    'id' => 'one',
    'fireDate' => '2020-08-30T01:02:03Z',
    'readDate' => '2020-08-30T01:02:03Z',
    'acknowledgedDate' => '2020-08-30T01:02:03Z',
    'message' => 'FAKE_MESSAGE',
    'reason' => 'FAKE_REASON',
    'customer' => 'johndoe',
    'process' => 1,
    'isAsync' => true,
    'eventType' => EventTypeEnum::TestEvent->value,
    'notificationType' => NotificationTypeEnum::TestNotification->value,
    'payload' => ['customer' => 'johndoe'],
];
