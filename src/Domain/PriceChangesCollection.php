<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class PriceChangesCollection extends AbstractCollection
{
    /** @var PriceChange[] */
    public array $entities;

    public static function fromArray(array $json): PriceChangesCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?PriceChange
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): PriceChange
    {
        return PriceChange::fromArray($json);
    }
}
