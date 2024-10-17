<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Notifications;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class NotificationsApiAckTest extends TestCase
{
    public function test_ack(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/notifications/1/ack', $this)
        );

        $sdk->notifications->ack('johndoe', 1);
    }
}
