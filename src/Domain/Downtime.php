<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;
use TypeError;

final class Downtime implements DomainObjectInterface
{
    public int $id;

    public DateTime $startDate;

    public DateTime $endDate;

    public ?string $reason;

    public Provider $provider;

    private function __construct(
        int $id,
        DateTime $startDate,
        DateTime $endDate,
        ?string $reason,
        Provider $provider
    ) {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->reason = $reason;
        $this->provider = $provider;
    }

    public static function fromArray(array $json): Downtime
    {
        try {
            $startDate = new DateTime($json['startDate']);
        } catch (\Throwable $th) {
            throw new TypeError('Invalid start date received');
        }
        try {
            $endDate = new DateTime($json['endDate']);
        } catch (\Throwable $th) {
            throw new TypeError('Invalid end date received');
        }

        return new Downtime(
            $json['id'],
            $startDate,
            $endDate,
            $json['reason'] ?? null,
            Provider::fromArray($json['provider'])
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'startDate' => $this->startDate->format('Y-m-d\TH:i:s\Z'),
            'endDate' => $this->endDate->format('Y-m-d\TH:i:s\Z'),
            'reason' => $this->reason,
            'provider' => $this->provider->toArray(),
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
