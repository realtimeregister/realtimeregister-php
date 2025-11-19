<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTimeInterface;
use RealtimeRegister\Domain\Enum\ValidationCategoryEnum;

class Validation implements DomainObjectInterface
{
    public DateTimeInterface $validatedOn;

    public int $version;

    public string $category;

    private function __construct(
        DateTimeInterface $validatedOn,
        int $version,
        string $category
    ) {
        $this->validatedOn = $validatedOn;
        $this->version = $version;
        $this->category = $category;
    }

    public static function fromArray(array $json): Validation
    {
        return new Validation(
            new \DateTime($json['validatedOn']),
            $json['version'],
            $json['category']
        );
    }

    public function toArray(): array
    {
        return [
            'validatedOn' => $this->validatedOn->format('Y-m-d\TH:i:s\Z'),
            'version' => $this->version,
            'category' => $this->category,
        ];
    }
}
