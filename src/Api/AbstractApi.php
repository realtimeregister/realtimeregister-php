<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Exceptions\InvalidArgumentException;
use RealtimeRegister\Support\AuthorizedClient;

abstract class AbstractApi
{
    protected AuthorizedClient $client;

    public function __construct(AuthorizedClient $client)
    {
        $this->client = $client;
    }

    /**
     * Default list query processing.
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     * @param array|null  $parameters
     *
     * @return array
     */
    public function processListQuery(?int $limit, ?int $offset, ?string $search, ?array $parameters): array
    {
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }
        if (! is_null($search)) {
            $query['q'] = $search;
        }

        if (! is_null($parameters)) {
            // Remove this special parameter, it should only be used for the export calls
            if (array_key_exists('export', $parameters)) {
                throw new InvalidArgumentException('Export parameter not allowed for this request, use the "export" request.');
            }
            $query = array_merge($parameters, $query);
        }
        return $query;
    }
}
