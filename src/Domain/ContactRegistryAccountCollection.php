<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ContactRegistryAccountCollection extends AbstractCollection
{
    /** @var ContactRegistryAccount[] */
    public array $entities;

    public static function fromArray(array $json): ContactRegistryAccountCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?ContactRegistryAccount
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): ContactRegistryAccount
    {
        return ContactRegistryAccount::fromArray($json);
    }
}
