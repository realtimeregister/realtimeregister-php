<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class VerificationCollection extends AbstractCollection
{
    /** @var Verification[] */
    public array $entities;

    public static function fromArray(array $json): VerificationCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Verification
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Verification
    {
        return Verification::fromArray($json);
    }
}
