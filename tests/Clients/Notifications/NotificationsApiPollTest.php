<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Notifications;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\NotificationPoll;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class NotificationsApiPollTest extends TestCase
{
    public function test_poll(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/notification_poll_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/notifications/poll', $this)
        );

        $response = $sdk->notifications->poll('johndoe');
        $this->assertInstanceOf(NotificationPoll::class, $response);
    }
}
