<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Support\AuthorizedClient;

abstract class AbstractApi
{
    protected AuthorizedClient $client;

    public function __construct(AuthorizedClient $client)
    {
        $this->client = $client;
    }
}
