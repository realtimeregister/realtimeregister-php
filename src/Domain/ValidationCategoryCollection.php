<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ValidationCategoryCollection extends AbstractCollection
{

    /** @var ValidationCategory[] */
    public array $entities;

    public static function fromArray(array $json): ValidationCategoryCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?ValidationCategory
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): ValidationCategory
    {
        return ValidationCategory::fromArray($json);
    }
}
