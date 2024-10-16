<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainStatusEnum;

class DomainRegistration implements DomainObjectInterface
{
    public string $domainName;

    public ?DateTime $expiryDate;

    public ?array $status;

    private function __construct(
        string $domainName,
        ?DateTime $expiryDate,
        ?array $status,
    ) {
        $this->domainName = $domainName;
        $this->expiryDate = $expiryDate;
        $this->status = $status;
    }

    public static function fromArray(array $json): DomainRegistration
    {

        if (isset($json['status'])) {
            foreach ($json['status'] as $status) {
                DomainStatusEnum::validate($status);
            }
        }

        return new DomainRegistration(
            $json['domainName'],
            $json['expiryDate'] ? new DateTime($json['expiryDate']) : null,
            $json['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'domainName' => $this->domainName,
            'expiryDate' => $this->expiryDate?->format('Y-m-d\TH:i:s\Z'),
            'status' => $this->status,
        ];
    }
}
