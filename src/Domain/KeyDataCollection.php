<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class KeyDataCollection extends AbstractCollection
{
    /** @var KeyData[] */
    public array $entities;

    public static function fromArray(array $json): KeyDataCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?KeyData
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): KeyData
    {
        return KeyData::fromArray($json);
    }
}
