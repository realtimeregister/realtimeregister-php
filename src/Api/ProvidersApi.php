<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\Downtime;
use RealtimeRegister\Domain\DowntimeCollection;
use RealtimeRegister\Domain\Provider;
use RealtimeRegister\Domain\ProviderCollection;
use RealtimeRegister\Domain\RegistryAccount;
use RealtimeRegister\Domain\RegistryAccountCollection;

final class ProvidersApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/providers/get */
    public function get(string $name): Provider
    {
        $response = $this->client->get(sprintf('v2/providers/REGISTRY/%s', urlencode($name)));
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
        return Downtime::fromArray($this->client->get(sprintf('v2/providers/downtime/%s', $id))->json());
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

    /**
     * Get a registry account by registry and login name (Gateway only).
     *
     * @param string $registry  - Registry name
     * @param string $loginName - Login name
     *
     * @see https://dm.realtimeregister.com/docs/api/registryAccount/get
     */
    public function getRegistryAccount(
        string $registry,
        string $loginName
    ): RegistryAccount {
        $response = $this->client->get(sprintf('v2/registryAccounts/%s/%s', urlencode($registry), urlencode($loginName)));
        return RegistryAccount::fromArray($response->json());
    }

    /**
     * List registry accounts.
     *
     * @param int|null    $limit      - Limit the number of results returned.
     * @param int|null    $offset     - Offset the results by this number of entities.
     * @param string|null $search     - Search term to filter results by.
     * @param array|null  $parameters - Additional query parameters.
     *
     * @see https://dm.realtimeregister.com/docs/api/registryAccount/list
     */
    public function listRegistryAccounts(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): RegistryAccountCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/registryAccounts', $query);
        return RegistryAccountCollection::fromArray($response->json());
    }
}
