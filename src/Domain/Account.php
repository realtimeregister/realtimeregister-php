<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class Account implements DomainObjectInterface
{
    public int $balance;

    public int $reservation;

    public string $currency;

    public int $locked;

    private function __construct(int $balance, int $reservation, string $currency, int $locked)
    {
        $this->balance = $balance;
        $this->reservation = $reservation;
        $this->currency = $currency;
        $this->locked = $locked;
    }

    public static function fromArray(array $json): Account
    {
        return new Account(
            $json['balance'],
            $json['reservation'],
            $json['currency'],
            $json['locked']
        );
    }

    public function toArray(): array
    {
        return [
            'balance' => $this->balance,
            'reservation' => $this->reservation,
            'currency' => $this->currency,
            'locked' => $this->locked,
        ];
    }
}
