<?php

declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use RealtimeRegister\Domain\Enum\DomainTransferTypeEnum;
use RealtimeRegister\Domain\Enum\LogStatusEnum;

final class DomainTransferStatus implements DomainObjectInterface
{
    public string $domainName;

    public string $registrar;

    public string $status;

    public DateTimeInterface $requestedDate;

    public DateTimeInterface $actionDate;

    public DateTimeInterface $expiryDate;

    public string $type;

    public int $processId;

    public ?LogCollection $log;

    private function __construct(
        string $domainName,
        string $status,
        DateTimeInterface $requestedDate,
        string $type,
        int $processId,
        DateTimeInterface $actionDate,
        DateTimeInterface $expiryDate,
        string $registrar,
        ?LogCollection $log = null
    ) {
        $this->domainName = $domainName;
        $this->registrar = $registrar;
        $this->status = $status;
        $this->requestedDate = $requestedDate;
        $this->actionDate = $actionDate;
        $this->expiryDate = $expiryDate;
        $this->type = $type;
        $this->processId = $processId;
        $this->log = $log;
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $json): DomainTransferStatus
    {
        DomainTransferTypeEnum::validate($json['type']);
        LogStatusEnum::validate($json['status']);

        return new DomainTransferStatus(
            $json['domainName'],
            $json['status'],
            new DateTimeImmutable($json['requestedDate']),
            $json['type'],
            $json['processId'],
            new DateTimeImmutable($json['actionDate']),
            new DateTimeImmutable($json['expiryDate']),
            $json['registrar'],
            isset($json['log']) ? LogCollection::fromArray($json['log']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'domainName' => $this->domainName,
                'registrar' => $this->registrar,
                'status' => $this->status,
                'requestedDate' => $this->requestedDate->format('Y-m-d\TH:i:s\Z'),
                'actionDate' =>  $this->actionDate->format('Y-m-d\TH:i:s\Z'),
                'expiryDate' => $this->expiryDate->format('Y-m-d\TH:i:s\Z'),
                'type' => $this->type,
                'processId' => $this->processId,
                'log' => $this->log ? $this->log->toArray() : null,
            ],
            static function ($x) {
                return ! is_null($x);
            }
        );
    }
}
