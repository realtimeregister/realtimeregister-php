<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class Quote implements DomainObjectInterface
{
    public function __construct(
        public readonly ?string $currency,
        public readonly int $total,
        public readonly ?BillableCollection $billables
    ) {
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->currency,
            'total' => $this->total,
            'billables' => $this->billables?->toArray(),
        ];
    }

    public static function fromArray(array $json): Quote
    {
        return new Quote(
            currency: $json['currency'] ?? null,
            total: $json['total'],
            billables: (array_key_exists('billables', $json) && $json['billables']) ? BillableCollection::fromArray($json['billables']) : null,
        );
    }
}
