<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\Notification;
use RealtimeRegister\Domain\NotificationCollection;
use RealtimeRegister\Domain\NotificationPoll;

final class NotificationsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/notifications/get */
    public function get(string $customer, int $notificationId): Notification
    {
        $response = $this->client->get("v2/customers/{$customer}/notifications/{$notificationId}");
        return Notification::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/list */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): NotificationCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get("v2/customers/{$customer}/notifications", $query);
        return NotificationCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/poll */
    public function poll(string $customer): NotificationPoll
    {
        $response = $this->client->get("v2/customers/{$customer}/notifications/poll");
        return NotificationPoll::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/ack */
    public function ack(string $customer, int $notificationId): void
    {
        $this->client->post("v2/customers/{$customer}/notifications/{$notificationId}/ack");
    }
}
