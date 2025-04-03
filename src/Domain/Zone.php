<?php
declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use RealtimeRegister\Domain\Enum\ZoneServiceEnum;

final class Zone implements DomainObjectInterface
{
    private function __construct(
        public int $id,
        public readonly ZoneServiceEnum $service,
        public ?string $template,
        public bool $dnssec,
        public ?bool $link = null,
        public ?string $master = null
    ) {
    }

    public static function fromArray(array $json): self
    {
        return new self(
            $json['id'],
            ZoneServiceEnum::from($json['service']),
            $json['template'] ?? null,
            $json['dnssec'],
            $json['link'] ?? null,
            $json['master'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'service' => $this->service->value,
            'template' => $this->template,
            'dnssec' => $this->dnssec,
            'link' => $this->link,
            'master' => $this->master,
        ], static function ($x) {
            return $x !== null;
        });
    }
}
