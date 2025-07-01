<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class DnsTemplateCollection extends AbstractCollection
{
    /** @var DnsTemplate[] */
    public array $entities;

    public static function fromArray(array $json): DnsTemplateCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DnsTemplate
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DnsTemplate
    {
        return DnsTemplate::fromArray($json);
    }
}
