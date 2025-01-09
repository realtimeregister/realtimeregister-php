<?php

declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use Exception;

class ValidationCollection extends AbstractCollection
{
    /** @var Validation[] */
    public array $entities;

    public static function fromArray(array $json): ValidationCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Validation
    {
        return $this->entities[$offset] ?? null;
    }

    /**
     * @throws Exception
     */
    public static function parseChild(array $json): Validation
    {
        return Validation::fromArray($json);
    }
}
