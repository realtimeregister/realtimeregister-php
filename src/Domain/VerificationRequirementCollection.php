<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class VerificationRequirementCollection extends AbstractCollection
{
    /** @var VerificationRequirement[] */
    public array $entities;

    public static function fromArray(array $json): VerificationRequirementCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?VerificationRequirement
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): VerificationRequirement
    {
        return VerificationRequirement::fromArray($json);
    }
}
