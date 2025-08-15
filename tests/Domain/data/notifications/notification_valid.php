<?php declare(strict_types = 1);

use RealtimeRegister\Domain\Enum\EventTypeEnum;
use RealtimeRegister\Domain\Enum\NotificationTypeEnum;

return [
    'id' => 1,
    'fireDate' => '2020-08-30T01:02:03Z',
    'readDate' => '2020-08-30T01:02:03Z',
    'acknowledgeDate' => '2020-08-30T01:02:03Z',
    'deliveryDate' => '2020-08-30T01:02:53Z',
    'message' => 'FAKE_MESSAGE',
    'reason' => 'FAKE_REASON',
    'customer' => 'johndoe',
    'process' => 1,
    'eventType' => EventTypeEnum::TestEvent->value,
    'notificationType' => NotificationTypeEnum::TestNotification->value,
    'payload' => ['customer' => 'johndoe'],
    'isAsync' => true,
];
