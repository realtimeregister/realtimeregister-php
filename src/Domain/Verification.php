<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;
use RealtimeRegister\Domain\Enum\VerificationClaimEnum;
use RealtimeRegister\Domain\Enum\VerificationMethodEnum;
use RealtimeRegister\Domain\Enum\VerificationProofEnum;

final class Verification implements DomainObjectInterface
{
    public DateTime $verificationDate;

    public string $method;

    public string $proof;

    /** @var array<string> */
    public array $claims;

    public string $source;

    public ?string $externalId;

    public DateTime $createdDate;

    public ?DateTime $updatedDate;

    private function __construct(
        DateTime $verificationDate,
        string $method,
        string $proof,
        array $claims,
        string $source,
        DateTime $createdDate,
        ?string $externalId = null,
        ?DateTime $updatedDate = null
    ) {
        $this->verificationDate = $verificationDate;
        $this->method = $method;
        $this->proof = $proof;
        $this->claims = $claims;
        $this->source = $source;
        $this->createdDate = $createdDate;
        $this->externalId = $externalId;
        $this->updatedDate = $updatedDate;
    }

    public static function fromArray(array $json): Verification
    {
        VerificationMethodEnum::validate($json['method']);
        VerificationProofEnum::validate($json['proof']);
        foreach ($json['claims'] as $claim) {
            VerificationClaimEnum::validate($claim);
        }

        return new Verification(
            new DateTime($json['verificationDate']),
            $json['method'],
            $json['proof'],
            $json['claims'],
            $json['source'],
            new DateTime($json['createdDate']),
            $json['externalId'] ?? null,
            isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'verificationDate' => $this->verificationDate->format('Y-m-d\TH:i:s\Z'),
            'method' => $this->method,
            'proof' => $this->proof,
            'claims' => $this->claims,
            'source' => $this->source,
            'externalId' => $this->externalId,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
