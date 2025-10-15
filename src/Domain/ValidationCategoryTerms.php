<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTimeImmutable;
use DateTimeInterface;

class ValidationCategoryTerms implements DomainObjectInterface
{
    public int $version;

    public string $terms;

    public ?DateTimeInterface $validTill;

    private function __construct(int $version, string $terms, ?\DateTimeInterface $validTill)
    {
        $this->version = $version;
        $this->terms = $terms;
        $this->validTill = $validTill;
    }

    /**
     * @throws \Exception
     */
    public static function fromArray(array $json)
    {
        return new ValidationCategoryTerms(
            $json['version'],
            $json['terms'],
            $json['validTill'] ? new DateTimeImmutable($json['validTill']) : null);
    }

    public function toArray(): array
    {
        return [
            'version' => $this->version,
            'terms' => $this->terms,
            'validTill' => $this->validTill
        ];
    }
}
