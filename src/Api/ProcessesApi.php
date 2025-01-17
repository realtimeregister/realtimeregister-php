<?php

declare(strict_types = 1);

namespace RealtimeRegister\Api;

use Exception;
use RealtimeRegister\Domain\Process;
use RealtimeRegister\Domain\ProcessCollection;
use RealtimeRegister\Domain\ProcessInfo;

final class ProcessesApi extends AbstractApi
{
    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/get
     *
     * @param int $processId
     *
     * @throws Exception
     *
     * @return Process
     */
    public function get(int $processId): Process
    {
        $response = $this->client->get(sprintf('v2/processes/%d', $processId));
        return Process::fromArray($response->json());
    }

    public function info(int $processId): ProcessInfo
    {
        $response = $this->client->get(sprintf('v2/processes/%d/info', $processId));
        return ProcessInfo::fromArray($response->json());
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/list
     *
     * @param int|null              $limit
     * @param int|null              $offset
     * @param string|null           $search
     * @param array<string, string> $parameters
     *
     * @return ProcessCollection
     */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ProcessCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/processes', $query);
        return ProcessCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/resend
     *
     * @param int $processId
     */
    public function resend(int $processId): void
    {
        $this->client->post(sprintf('v2/processes/%d/resend', $processId));
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/cancel
     *
     * @param int $processId
     */
    public function delete(int $processId): void
    {
        $this->client->delete(sprintf('v2/processes/%d', $processId));
    }

    public function export(array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('v2/processes', $query);
        return $response->json()['entities'];
    }
}
