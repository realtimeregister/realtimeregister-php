<?php declare(strict_types=1);

namespace RealtimeRegister\Domain;


use DateTime;
use RealtimeRegister\Domain\Enum\AcmeSubscriptionStatusEnum;

final class AcmeSubscription implements DomainObjectInterface
{
    public int $id;

    public ?array $domainNames;

    public string $product;

    public ?string $organization;

    public ?string $address;

    public ?string $city;

    public ?string $state;

    public ?string $postalCode;

    public ?string $country;

    public ?Approver $approver;

    public DateTime $expiryDate;

    public DateTime $createdDate;

    public ?DateTime $updatedDate;

    public int $period;

    public string $directoryUrl;

    public bool $autoRenew;

    public ?int $certValidity;

    public ?DateTime $orgValidUntil;

    public ?string $organizationId;

    public string $status;

    private function __construct(
        ?int                               $id,
        array                              $domainNames,
        string                             $product,
        ?string                            $organization,
        ?string                            $address,
        ?string                            $city,
        ?string                            $state,
        ?string                            $postalCode,
        ?string                            $country,
        ?Approver                          $approver,
        DateTime                           $expiryDate,
        DateTime                           $createdDate,
        ?DateTime                          $updatedDate,
        ?int                               $period,
        ?string                            $directoryUrl,
        ?bool                              $autoRenew,
        ?int                               $certValidity,
        ?DateTime                          $orgValidUntil,
        ?string                            $organizationId,
        string                             $status
    )
    {
        $this->id = $id;
        $this->domainNames = $domainNames;
        $this->product = $product;
        $this->organization = $organization;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->approver = $approver;
        $this->expiryDate = $expiryDate;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->period = $period;
        $this->directoryUrl = $directoryUrl;
        $this->autoRenew = $autoRenew;
        $this->certValidity = $certValidity;
        $this->orgValidUntil = $orgValidUntil;
        $this->organizationId = $organizationId;
        $this->status = $status;
    }

    /**
     * @throws \Exception
     */
    public static function fromArray(array $json): AcmeSubscription
    {

        AcmeSubscriptionStatusEnum::validate($json['status']);

        return new AcmeSubscription(
            $json['id'],
            $json['domainNames'],
            $json['product'],
            $json['organization'],
            $json['address'],
            $json['city'],
            $json['state'],
            $json['postalCode'],
            $json['country'],
            isset($json['approver']) ? Approver::fromArray($json['approver']) : null,
            new DateTime($json['expiryDate']),
            new DateTime($json['createdDate']),
            isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null,
            $json['period'],
            $json['directoryUrl'],
            $json['autoRenew'] ?? null,
            $json['certValidity'] ?? null,
            isset($json['orgValidUntil']) ? new DateTime($json['orgValidUntil']) : null,
            $json['organizationId'] ?? null,
            $json['status']
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'domainNames' => $this->domainNames,
            'product' => $this->product,
            'organization' => $this->organization,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postalCode,
            'country' => $this->country,
            'approver' => $this->approver?->toArray(),
            'expiryDate' => $this->expiryDate->format('Y-m-d\TH:i:s\Z'),
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
            'period' => $this->period,
            'directoryUrl' => $this->directoryUrl,
            'autoRenew' => $this->autoRenew,
            'certValidity' => $this->certValidity,
            'orgValidUntil' => $this->orgValidUntil?->format('Y-m-d\TH:i:s\Z'),
            'organizationId' => $this->organizationId,
            'status' => $this->status,
        ], static function ($value) {
            return !is_null($value);
        });
    }
}
