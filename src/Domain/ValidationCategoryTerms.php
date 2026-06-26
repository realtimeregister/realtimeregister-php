<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTimeImmutable;
use DateTimeInterface;

class ValidationCategoryTerms implements DomainObjectInterface
{
    public int $version;

    public string $terms;

    public ?DateTimeInterface $validUntil;

    private function __construct(int $version, string $terms, ?\DateTimeInterface $validUntil)
    {
        $this->version = $version;
        $this->terms = $terms;
        $this->validUntil = $validUntil;
    }

    /**
     * @throws \Exception
     */
    public static function fromArray(array $json): ValidationCategoryTerms
    {
        $validUntil = $json['validUntil'] ?? null;

        return new ValidationCategoryTerms(
            $json['version'],
            $json['terms'],
            $validUntil ? new DateTimeImmutable($validUntil) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'terms' => $this->terms,
            'validUntil' => $this->validUntil?->format('Y-m-d\TH:i:s\Z'),
            'version' => $this->version,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
