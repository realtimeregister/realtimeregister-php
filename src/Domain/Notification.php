<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;

final class Notification implements DomainObjectInterface
{
    public int $id;

    public DateTime $fireDate;

    public ?DateTime $readDate;

    public ?DateTime $acknowledgeDate;

    public ?DateTime $deliveryDate;

    public string $message;

    public ?string $reason;

    public ?string $customer;

    public ?int $process;

    public string $eventType;

    public string $notificationType;

    /** @var array<string>|null */
    public ?array $payload;

    public bool $isAsync;

    public ?string $processIndentifier;

    public ?string $processType;

    private function __construct(
        int $id,
        DateTime $fireDate,
        ?DateTime $readDate,
        ?DateTime $acknowledgeDate,
        ?DateTime $deliveryDate,
        string $message,
        ?string $reason,
        ?string $customer,
        ?int $process,
        string $eventType,
        string $notificationType,
        bool $isAsync,
        ?array $payload = null,
        ?string $processIndentifier = null,
        ?string $processType = null
    ) {
        $this->id = $id;
        $this->fireDate = $fireDate;
        $this->readDate = $readDate;
        $this->acknowledgeDate = $acknowledgeDate;
        $this->deliveryDate = $deliveryDate;
        $this->message = $message;
        $this->reason = $reason;
        $this->customer = $customer;
        $this->process = $process;
        $this->eventType = $eventType;
        $this->notificationType = $notificationType;
        $this->payload = $payload;
        $this->isAsync = $isAsync;
        $this->processIndentifier = $processIndentifier;
        $this->processType = $processType;
    }

    public static function fromArray(array $json): Notification
    {
        return new Notification(
            $json['id'],
            new DateTime($json['fireDate']),
            isset($json['readDate']) ? new DateTime($json['readDate']) : null,
            isset($json['acknowledgeDate']) ? new DateTime($json['acknowledgeDate']) : null,
            isset($json['deliveryDate']) ? new DateTime($json['deliveryDate']) : null,
            $json['message'],
            $json['reason'] ?? null,
            $json['customer'] ?? null,
            $json['process'] ?? null,
            $json['eventType'],
            $json['notificationType'],
            $json['isAsync'],
            $json['payload'] ?? null,
            $json['processIndentifier'] ?? null,
            $json['processType'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'fireDate' => $this->fireDate->format('Y-m-d\TH:i:s\Z'),
            'readDate' => $this->readDate?->format('Y-m-d\TH:i:s\Z'),
            'acknowledgeDate' => $this->acknowledgeDate?->format('Y-m-d\TH:i:s\Z'),
            'deliveryDate' => $this->deliveryDate?->format('Y-m-d\TH:i:s\Z'),
            'message' => $this->message,
            'reason' => $this->reason,
            'customer' => $this->customer,
            'process' => $this->process,
            'eventType' => $this->eventType,
            'notificationType' => $this->notificationType,
            'payload' => $this->payload,
            'isAsync' => $this->isAsync,
            'processIndentifier' => $this->processIndentifier,
            'processType' => $this->processType,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
