<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use RealtimeRegister\Domain\Enum\DocsEnum;
use RealtimeRegister\Domain\Enum\OrganizationEnum;
use RealtimeRegister\Domain\Enum\VoiceEnum;
use RealtimeRegister\Domain\Enum\WhoisEnum;

class CertificateValidation implements DomainObjectInterface
{
    public function __construct(
        public ?string $organization = null,
        public ?string $docs = null,
        public ?string $voice = null,
        public ?string $whois = null,
        public ?DomainControlValidationCollection $dcv = null
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'organization' => $this->organization,
            'docs' => $this->docs,
            'voice' => $this->voice,
            'whois' => $this->whois,
            'dcv' => $this->dcv?->toArray(),
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): CertificateValidation
    {
        if (array_key_exists('organization', $json)) {
            OrganizationEnum::validate($json['organization']);
        }
        if (array_key_exists('docs', $json)) {
            DocsEnum::validate($json['docs']);
        }
        if (array_key_exists('voice', $json)) {
            VoiceEnum::validate($json['voice']);
        }
        if (array_key_exists('whois', $json)) {
            WhoisEnum::validate($json['whois']);
        }

        return new CertificateValidation(
            $json['organization'] ?? null,
            $json['docs'] ?? null,
            $json['voice'] ?? null,
            $json['whois'] ?? null,
            $json['dcv'] ? DomainControlValidationCollection::fromArray($json['dcv']) : null,
        );
    }
}
