<?php declare(strict_types = 1);

use RealtimeRegister\Domain\Enum\EventTypeEnum;
use RealtimeRegister\Domain\Enum\NotificationTypeEnum;

return [
    'id' => 1,
    'fireDate' => '2020-08-30T01:02:03Z',
    'message' => 'FAKEMESSAGE',
    'eventType' => EventTypeEnum::TestEvent->value,
    'notificationType' => NotificationTypeEnum::TestNotification->value,
    'isAsync' => true,
];
