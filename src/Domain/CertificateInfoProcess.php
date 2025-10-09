<?php

declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class CertificateInfoProcess implements DomainObjectInterface
{
    public function __construct(
        public string $commonName,
        public bool $requiresAttention,
        public ?int $certificateId = null,
        public ?CertificateValidation $validations = null,
        public ?int $processId = null
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'commonName' => $this->commonName,
            'requiresAttention' => $this->requiresAttention,
            'certificateId' => $this->certificateId,
            'validations' => $this->validations?->toArray(),
            'processId' => $this->processId,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): CertificateInfoProcess
    {
        return new CertificateInfoProcess(
            $json['commonName'],
            $json['requiresAttention'] ?? false,
            $json['certificateId'] ?? null,
            $json['validations'] ? CertificateValidation::fromArray($json['validations']) : null,
            array_key_exists('headers', $json) ? self::getProcessId($json['headers']) : null
        );
    }

    private static function getProcessId(array $json): ?int
    {
        return array_key_exists('x-process-id', $json) ? (int) $json['x-process-id'][0] : null;
    }
}
