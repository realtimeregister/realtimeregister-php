<?php

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\ValidationCategory;
use RealtimeRegister\Domain\ValidationCategoryCollection;

class ValidationApi extends AbstractApi
{

    /* @see https://dm.realtimeregister.com/docs/api/validation/list */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ValidationCategoryCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/validation/categories', $query);
        return ValidationCategoryCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/validation/get */
    public function get(string $name): ValidationCategory
    {
        $response = $this->client->get(sprintf('v2/validation/categories/%s', urlencode($name)));
        return ValidationCategory::fromArray($response->json());
    }
}
