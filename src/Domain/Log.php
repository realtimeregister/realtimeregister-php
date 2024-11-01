<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;
use RealtimeRegister\Domain\Enum\LogStatusEnum;

final class Log implements DomainObjectInterface
{
    public DateTime $date;

    public string $status;

    public string $message;

    private function __construct(DateTime $date, string $status, string $message)
    {
        $this->date = $date;
        $this->status = $status;
        $this->message = $message;
    }

    public static function fromArray(array $json): Log
    {
        LogStatusEnum::validate($json['status']);
        return new Log(
            new DateTime($json['date']),
            $json['status'],
            $json['message']
        );
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date->format('Y-m-d\TH:i:s\Z'),
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}
