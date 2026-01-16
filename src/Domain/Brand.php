<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;

final class Brand implements DomainObjectInterface
{
    public string $customer;

    public string $handle;

    public string $locale;

    public string $organization;

    /** @var string[] */
    public array $addressLine;

    public string $postalCode;

    public string $city;

    public ?string $state;

    public string $country;

    public string $email;

    public ?string $contactUrl;

    public ?string $url;

    public string $voice;

    public ?string $fax;

    public ?string $privacyContact;

    public ?string $abuseContact;

    public ?bool $hideOptionalTerms;

    public DateTime $createdDate;

    public ?DateTime $updatedDate;

    public ?DateTime $spfInvalidSince;

    public ?DateTime $dkimInvalidSince;

    public ?string $dkimSelector;

    private function __construct(
        string $customer,
        string $handle,
        string $locale,
        string $organization,
        array $addressLine,
        string $postalCode,
        string $city,
        ?string $state,
        string $country,
        string $email,
        ?string $contactUrl,
        ?string $url,
        string $voice,
        ?string $fax,
        ?string $privacyContact,
        ?string $abuseContact,
        DateTime $createdDate,
        ?DateTime $updatedDate = null,
        ?DateTime $spfInvalidSince = null,
        ?DateTime $dkimInvalidSince = null,
        ?string $dkimSelector = null,
        ?bool $hideOptionalTerms = false
    ) {
        $this->hideOptionalTerms = $hideOptionalTerms;
        $this->customer = $customer;
        $this->handle = $handle;
        $this->locale = $locale;
        $this->organization = $organization;
        $this->addressLine = $addressLine;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->email = $email;
        $this->contactUrl = $contactUrl;
        $this->url = $url;
        $this->voice = $voice;
        $this->fax = $fax;
        $this->privacyContact = $privacyContact;
        $this->abuseContact = $abuseContact;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->spfInvalidSince = $spfInvalidSince;
        $this->dkimInvalidSince = $dkimInvalidSince;
        $this->dkimSelector = $dkimSelector;
    }

    public static function fromArray(array $json): Brand
    {
        $updatedDate = isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null;
        $spfInvalidSince = isset($json['spfInvalidSince']) ? new DateTime($json['spfInvalidSince']) : null;
        $dkimInvalidSince = isset($json['dkimInvalidSince']) ? new DateTime($json['dkimInvalidSince']) : null;

        return new Brand(
            $json['customer'],
            $json['handle'],
            $json['locale'],
            $json['organization'],
            $json['addressLine'],
            $json['postalCode'],
            $json['city'],
            $json['state'] ?? null,
            $json['country'],
            $json['email'],
            $json['contactUrl'] ?? null,
            $json['url'] ?? null,
            $json['voice'],
            $json['fax'] ?? null,
            $json['privacyContact'] ?? null,
            $json['abuseContact'] ?? null,
            new DateTime($json['createdDate']),
            $updatedDate,
            $spfInvalidSince,
            $dkimInvalidSince,
            $json['dkimSelector'] ?? null,
            $json['hideOptionalTerms'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
            'handle' => $this->handle,
            'locale' => $this->locale,
            'organization' => $this->organization,
            'addressLine' => $this->addressLine,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'email' => $this->email,
            'contactUrl' => $this->contactUrl,
            'url' => $this->url,
            'voice' => $this->voice,
            'fax' => $this->fax,
            'privacyContact' => $this->privacyContact,
            'abuseContact' => $this->abuseContact,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
            'spfInvalidSince' => $this->spfInvalidSince?->format('Y-m-d\TH:i:s\Z'),
            'dkimInvalidSince' => $this->dkimInvalidSince?->format('Y-m-d\TH:i:s\Z'),
            'dkimSelector' => $this->dkimSelector,
            'hideOptionalTerms' => $this->hideOptionalTerms ?? null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
