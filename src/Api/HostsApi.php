<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\DnsHost;
use RealtimeRegister\Domain\DnsHostAddressCollection;
use RealtimeRegister\Domain\DnsHostCollection;
use RealtimeRegister\Exceptions\InvalidArgumentException;

final class HostsApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/hosts/list
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     * @param array|null  $parameters
     *
     * @throws InvalidArgumentException
     *
     * @return DnsHostCollection
     */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DnsHostCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/hosts', $query);
        return DnsHostCollection::fromArray($response->json());
    }

    public function export(array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('v2/hosts', $query);
        return $response->json()['entities'];
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/hosts/get
     *
     * @param string $hostName
     *
     * @return DnsHost
     */
    public function get(string $hostName): DnsHost
    {
        $response = $this->client->get(
            sprintf('v2/hosts/%s', $hostName)
        );
        return DnsHost::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/hosts/create
     *
     * @throws InvalidArgumentException
     */
    public function create(
        string $hostName,
        ?DnsHostAddressCollection $addresses = null
    ): void {
        $payload = [
            'hostName' => $hostName,
        ];
        if ($addresses !== null) {
            $payload['addresses'] = $addresses->toArray();
        }

        $this->client->post(sprintf('v2/hosts/%s', $hostName), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/hosts/update
     */
    public function update(
        string $hostName,
        ?DnsHostAddressCollection $addresses
    ): void {
        $payload = [
            'hostName' => $hostName,
        ];

        if ($addresses instanceof DnsHostAddressCollection) {
            $payload['addresses'] = $addresses->toArray();
        }

        $this->client->post(sprintf('v2/hosts/%s/update', $hostName), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/hosts/delete
     */
    public function delete(string $hostName): void
    {
        $this->client->delete(
            sprintf('v2/hosts/%s', $hostName)
        );
    }
}
