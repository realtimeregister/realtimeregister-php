<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use RealtimeRegister\Domain\Enum\VerificationClaimEnum;
use RealtimeRegister\Domain\Enum\VerificationMethodEnum;
use RealtimeRegister\Domain\Enum\VerificationProofEnum;

final class VerificationRequirement implements DomainObjectInterface
{
    /** @var array<string> Any of these claims must be present in the verification */
    public array $claims;

    /** @var array<string>|null The allowed verification methods, any method is allowed if absent */
    public ?array $methods;

    /** @var array<string>|null The allowed verification proofs, any proof is allowed if absent */
    public ?array $proofs;

    /** The maximum age of the verification as ISO-8601 period (e.g. "P1Y") */
    public ?string $maxAge;

    private function __construct(array $claims, ?array $methods = null, ?array $proofs = null, ?string $maxAge = null)
    {
        $this->claims = $claims;
        $this->methods = $methods;
        $this->proofs = $proofs;
        $this->maxAge = $maxAge;
    }

    public static function fromArray(array $json): VerificationRequirement
    {
        foreach ($json['claims'] as $claim) {
            VerificationClaimEnum::validate($claim);
        }
        foreach ($json['methods'] ?? [] as $method) {
            VerificationMethodEnum::validate($method);
        }
        foreach ($json['proofs'] ?? [] as $proof) {
            VerificationProofEnum::validate($proof);
        }

        return new VerificationRequirement(
            $json['claims'],
            $json['methods'] ?? null,
            $json['proofs'] ?? null,
            $json['maxAge'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'claims' => $this->claims,
            'methods' => $this->methods,
            'proofs' => $this->proofs,
            'maxAge' => $this->maxAge,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
