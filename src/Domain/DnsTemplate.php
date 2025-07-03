<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;

final class DnsTemplate implements DomainObjectInterface
{
    public string $customer;

    public string $templateName;

    public DateTime $createdDate;

    public ?DateTime $lastUpdatedDate;

    public string $hostMaster;

    public int $refresh;

    public int $retry;

    public int $expire;

    public int $ttl;

    public ?DomainZoneRecordCollection $defaultRecords = null;

    public ?DomainZoneRecordCollection $records = null;

    private function __construct(
        string $customer,
        string $templateName,
        DateTime $createdDate,
        string $hostMaster = 'hostmaster@realtimeregister.com',
        int $refresh = 3600,
        int $retry = 3600,
        int $expire = 14 * 24 * 60 * 60,
        int $ttl = 3600,
        ?array $defaultRecords = null,
        ?array $records = null,
        ?DateTime $lastUpdatedDate = null
    ) {
        $this->customer = $customer;
        $this->templateName = $templateName;
        $this->createdDate = $createdDate;
        $this->lastUpdatedDate = $lastUpdatedDate;
        $this->hostMaster = $hostMaster;
        $this->refresh = $refresh;
        $this->retry = $retry;
        $this->expire = $expire;
        $this->ttl = $ttl;
        if ($defaultRecords !== null) {
            $this->defaultRecords = DomainZoneRecordCollection::fromArray($defaultRecords);
        }
        if ($records !== null) {
            $this->records = DomainZoneRecordCollection::fromArray($records);
        }
    }

    public static function fromArray(array $json): DnsTemplate
    {
        return new DnsTemplate(
            $json['customer'],
            $json['templateName'],
            new DateTime($json['createdDate']),
            $json['hostMaster'],
            $json['refresh'],
            $json['retry'],
            $json['expire'],
            $json['ttl'],
            $json['defaultRecords'] ?? null,
            $json['records'] ?? null,
            isset($json['lastUpdatedDate']) ? new DateTime($json['lastUpdatedDate']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer'       => $this->customer,
            'templateName'   => $this->templateName,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'hostMaster'     => $this->hostMaster,
            'refresh'        => $this->refresh,
            'retry'          => $this->retry,
            'expire'         => $this->expire,
            'ttl'            => $this->ttl,
            'defaultRecords' => ($this->defaultRecords !== null ? $this->defaultRecords->toArray() : null),
            'records'        => ($this->records !== null ? $this->records->toArray() : null),
            'lastUpdatedDate' => $this->lastUpdatedDate ? $this->lastUpdatedDate->format('Y-m-d\TH:i:s\Z') : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
