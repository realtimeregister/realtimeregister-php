<?php

namespace RealtimeRegister\Domain;

class RegistryAccountCollection extends AbstractCollection
{
    /** @var RegistryAccount[] */
    public array $entities;

    public static function fromArray(array $json): RegistryAccountCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?RegistryAccount
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): RegistryAccount
    {
        return RegistryAccount::fromArray($json);
    }
}
