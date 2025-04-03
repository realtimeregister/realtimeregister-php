<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use RealtimeRegister\Domain\Enum\BillableActionEnum;

final class Billable implements DomainObjectInterface
{
    public function __construct(
        public readonly string $product,
        public readonly BillableActionEnum $action,
        public readonly int $quantity,
        public readonly ?int $amount = null,
        public readonly ?bool $refundable = null,
        public readonly ?int $total = null,
        public readonly ?string $providerName = null
    ) {
    }

    public static function fromArray(array $json): Billable
    {
        return new Billable(
            product: $json['product'],
            action: BillableActionEnum::from($json['action']),
            quantity: $json['quantity'],
            amount: $json['amount'] ?? null,
            refundable: $json['refundable'] ?? null,
            total: $json['total'] ?? null,
            providerName: $json['providerName'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'product' => $this->product,
            'action' => $this->action->value,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'refundable' => $this->refundable,
            'total' => $this->total,
            'providerName' => $this->providerName,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
