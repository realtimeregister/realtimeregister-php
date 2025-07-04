<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use InvalidArgumentException;
use RealtimeRegister\Domain\DnsZone;
use RealtimeRegister\Domain\DnsZoneCollection;
use RealtimeRegister\Domain\DomainZoneRecordCollection;
use RealtimeRegister\Domain\DomainZoneStatistics;
use RealtimeRegister\Domain\Enum\ZoneServiceEnum;
use Webmozart\Assert\Assert;

final class DnsZonesApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/list
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     * @param array|null  $parameters
     *
     * @throws InvalidArgumentException
     *
     * @return DnsZoneCollection
     */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DnsZoneCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/dns/zones', $query);
        return DnsZoneCollection::fromArray($response->json());
    }

    public function export(array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('v2/dns/zones', $query);
        return $response->json()['entities'];
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/get
     *
     * @param int $id
     *
     * @throws InvalidArgumentException
     *
     * @return DnsZone
     */
    public function get(int $id): DnsZone
    {
        $response = $this->client->get(
            sprintf('v2/dns/zones/%s', $id)
        );
        return DnsZone::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/create
     *
     * @throws InvalidArgumentException
     */
    public function create(
        string $name,
        ?ZoneServiceEnum $service = null,
        ?string $template = null,
        ?bool $link = null,
        ?string $master = null,
        ?array $ns = null,
        ?bool $dnssec = null,
        ?string $hostMaster = null,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $ttl = null,
        ?DomainZoneRecordCollection $records = null,
    ): int {
        $this->validateZoneName($name);

        $payload = [
            'name' => $name,
        ];
        if ($service !== null) {
            $payload['service'] = $service->value;
        }
        if ($template !== null) {
            $payload['template'] = $template;
        }
        if ($link !== null) {
            $payload['link'] = $link;
        }
        if ($master !== null) {
            $payload['master'] = $master;
        }
        if ($ns !== null) {
            $payload['ns'] = $ns;
        }
        if ($dnssec !== null) {
            $payload['dnssec'] = $dnssec;
        }
        if ($hostMaster !== null) {
            $payload['hostMaster'] = $hostMaster;
        }
        if ($refresh !== null) {
            $payload['refresh'] = $refresh;
        }
        if ($retry !== null) {
            $payload['retry'] = $retry;
        }
        if ($expire !== null) {
            $payload['expire'] = $expire;
        }
        if ($ttl !== null) {
            $payload['ttl'] = $ttl;
        }
        if ($records !== null) {
            $payload['records'] = $records->toArray();
        }
        $response = $this->client->post('v2/dns/zones', $payload);
        return $response->json()['id'];
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/update
     *
     * @throws InvalidArgumentException
     */
    public function update(
        int $id,
        ?string $name = null,
        ?ZoneServiceEnum $service = null,
        ?string $template = null,
        ?bool $link = null,
        ?string $master = null,
        ?array $ns = null,
        ?bool $dnssec = null,
        ?string $hostMaster = null,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $ttl = null,
        ?DomainZoneRecordCollection $records = null,
    ): void {
        $payload = [];
        if ($name !== null) {
            $this->validateZoneName($name);
            $payload['name'] = $name;
        }
        if ($service !== null) {
            $payload['service'] = $service->value;
        }
        if ($template !== null) {
            $payload['template'] = $template;
        }
        if ($link !== null) {
            $payload['link'] = $link;
        }
        if ($master !== null) {
            $payload['master'] = $master;
        }
        if ($ns !== null) {
            $payload['ns'] = $ns;
        }
        if ($dnssec !== null) {
            $payload['dnssec'] = $dnssec;
        }
        if ($hostMaster !== null) {
            $payload['hostMaster'] = $hostMaster;
        }
        if ($refresh !== null) {
            $payload['refresh'] = $refresh;
        }
        if ($retry !== null) {
            $payload['retry'] = $retry;
        }
        if ($expire !== null) {
            $payload['expire'] = $expire;
        }
        if ($ttl !== null) {
            $payload['ttl'] = $ttl;
        }
        if ($records !== null) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf('v2/dns/zones/%s/update', $id),
            $payload,
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/delete
     *
     * @param int $id The id of the zone to delete
     */
    public function delete(int $id): void
    {
        $this->client->delete(
            sprintf('v2/dns/zones/%s', $id)
        );
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/stats */
    public function statistics(int $zoneId): DomainZoneStatistics
    {
        $result = $this->client->get(sprintf('v2/dns/zones/%s/stats', $zoneId));

        return DomainZoneStatistics::fromArray($result->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/retrieve */
    public function retrieve(int $zoneId): void
    {
        $this->client->post(sprintf('v2/dns/zones/%s/retrieve', $zoneId));
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/key-rollover */
    public function keyRollover(int $zoneId): void
    {
        $this->client->post(sprintf('v2/dns/zones/%s/key-rollover', $zoneId));
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/ack-ds-update */
    public function ackDSUpdate(int $processId): void
    {
        $this->client->post(sprintf('v2/processes/%s/ack-ds-update', $processId));
    }

    /**
     * Validate zone name input.
     *
     * @param string $name Zone name
     *
     * @throws InvalidArgumentException
     */
    private function validateZoneName(string $name): void
    {
        Assert::lengthBetween($name, 3, 40, 'Zone name should be between 3 and 40 characters');
        Assert::regex($name, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid zone name, allowed characters: a-z A-Z 0-9 - _ @ .');
    }
}
