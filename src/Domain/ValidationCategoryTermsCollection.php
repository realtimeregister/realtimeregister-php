<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ValidationCategoryTermsCollection extends AbstractCollection
{
    /** @var ValidationCategoryTerms[] */
    public array $entities;

    public static function fromArray(array $json): ValidationCategoryTermsCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?ValidationCategoryTerms
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): ValidationCategoryTerms
    {
        return ValidationCategoryTerms::fromArray($json);
    }
}
