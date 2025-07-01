<?php

declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ProcessInfo implements DomainObjectInterface
{
    private string $commonName;

    private bool $requiresAttention;

    private ?int $certificateId;

    private ?string $oneTimeLink;

    private ?array $validations;

    private ?array $notes;

    public function __construct(
        string $commonName,
        bool $requiresAttention,
        ?int $certificateId,
        ?string $oneTimeLink,
        ?array $validations = null,
        ?array $notes = null
    ) {
        $this->commonName = $commonName;
        $this->requiresAttention = $requiresAttention;
        $this->certificateId = $certificateId;
        $this->oneTimeLink = $oneTimeLink;
        $this->validations = $validations;
        $this->notes = $notes;
    }

    public function toArray(): array
    {
        return array_filter([
            'commonName' => $this->commonName,
            'requiresAttention' => $this->requiresAttention,
            'certificateId' => $this->certificateId,
            'oneTimeLink' => $this->oneTimeLink,
            'validations' => $this->validations,
            'notes' => $this->notes,
        ], fn ($v) => ! is_null($v));
    }

    public static function fromArray(array $json): self
    {
        return new self(
            $json['commonName'],
            $json['requiresAttention'] ?? false,
            $json['certificateId'] ?? null,
            $json['oneTimeLink'] ?? null,
            $json['validations'] ?? null,
            $json['notes'] ?? null
        );
    }
}
