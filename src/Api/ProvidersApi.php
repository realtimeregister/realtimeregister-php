<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\Downtime;
use RealtimeRegister\Domain\DowntimeCollection;
use RealtimeRegister\Domain\Provider;
use RealtimeRegister\Domain\ProviderCollection;

final class ProvidersApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/providers/get */
    public function get(string $name): Provider
    {
        $response = $this->client->get("/v2/providers/REGISTRY/{$name}");
        return Provider::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/list */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ProviderCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/providers', $query);
        return ProviderCollection::fromArray($response->json());
    }

    public function export(array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('v2/providers', $query);
        return $response->json()['entities'];
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/downtime/get */
    public function getDowntime(int $id): Downtime
    {
        return Downtime::fromArray($this->client->get("/v2/providers/downtime/{$id}")->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/downtime/list */
    public function listDowntimes(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DowntimeCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/providers/downtime', $query);
        return DowntimeCollection::fromArray($response->json());
    }
}
