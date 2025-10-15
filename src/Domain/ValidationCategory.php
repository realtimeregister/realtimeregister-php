<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ValidationCategory implements DomainObjectInterface
{
    public string $name;

    public string $description;

    /** @var array<string> */
    public ?array $fields;

    public ValidationCategoryTermsCollection $terms;

    private function __construct(string $name, string $description, array $fields, array $terms) {
        $this->name = $name;
        $this->description = $description;
        $this->fields = $fields;
        $this->terms = ValidationCategoryTermsCollection::fromArray($terms);
    }

    public static function fromArray(array $json): ValidationCategory
    {
        return new ValidationCategory(
            $json['name'],
            $json['description'],
            $json['fields'] ?? null,
            $json['terms']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'fields' => $this->fields,
            'terms' => $this->terms
        ];
    }
}
