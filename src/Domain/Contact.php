<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use DateTime;
use RealtimeRegister\Domain\Enum\DisclosedField;

final class Contact implements DomainObjectInterface
{
    public string $customer;

    public string $handle;

    public string $brand;

    public string $name;

    /** @var string[] */
    public array $addressLine;

    public string $postalCode;

    public string $city;

    public ?string $state;

    public string $country;

    public string $email;

    public string $voice;

    public ?string $organization;

    public ?string $fax;

    /** @var string[]|null */
    public ?array $registries;

    /** @var array<string, array<string, string>>|null */
    public ?array $properties;

    public Datetime $createdDate;

    public ?Datetime $updatedDate;

    public ?array $disclosedFields;

    public ?ValidationCollection $validations;

    public ?ContactRegistryAccountCollection $registryAccounts;

    private function __construct(
        string $customer,
        string $handle,
        string $brand,
        ?string $organization,
        string $name,
        array $addressLine,
        string $postalCode,
        string $city,
        ?string $state,
        string $country,
        string $email,
        string $voice,
        ?string $fax,
        ?array $registries,
        ?array $properties,
        DateTime $createdDate,
        ?DateTime $updatedDate = null,
        ?ValidationCollection $validations = null,
        ?ContactRegistryAccountCollection $registryAccounts = null,
        ?array $disclosedFields = null
    ) {
        $this->customer = $customer;
        $this->handle = $handle;
        $this->brand = $brand;
        $this->organization = $organization;
        $this->name = $name;
        $this->addressLine = $addressLine;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->email = $email;
        $this->voice = $voice;
        $this->fax = $fax;
        $this->registries = $registries;
        $this->properties = $properties;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->validations = $validations;
        $this->registryAccounts = $registryAccounts;
        $this->disclosedFields = $disclosedFields;
    }

    public static function fromArray(array $json): Contact
    {
        $updatedDate = isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null;

        if (array_key_exists('disclosedFields', $json) && is_array($json['disclosedFields'])) {
            foreach ($json['disclosedFields'] as $status) {
                DisclosedField::validate($status);
            }
        }

        return new Contact(
            $json['customer'],
            $json['handle'],
            $json['brand'],
            $json['organization'] ?? null,
            $json['name'],
            $json['addressLine'],
            $json['postalCode'],
            $json['city'],
            $json['state'] ?? null,
            $json['country'],
            $json['email'],
            $json['voice'],
            $json['fax'] ?? null,
            $json['registries'] ?? null,
            $json['properties'] ?? null,
            new DateTime($json['createdDate']),
            $updatedDate,
            (isset($json['validations']) && is_array($json['validations'])) ? ValidationCollection::fromArray($json['validations']) : null,
            (isset($json['registryAccounts']) && is_array($json['registryAccounts'])) ? ContactRegistryAccountCollection::fromArray($json['registryAccounts']) : null,
            (isset($json['disclosedFields']) && is_array($json['disclosedFields'])) ? $json['disclosedFields'] : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
            'handle' => $this->handle,
            'brand' => $this->brand,
            'organization' => $this->organization,
            'name' => $this->name,
            'addressLine' => $this->addressLine,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'email' => $this->email,
            'voice' => $this->voice,
            'fax' => $this->fax,
            'registries' => $this->registries,
            'properties' => $this->properties,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate ? $this->updatedDate->format('Y-m-d\TH:i:s\Z') : null,
            'validations' => $this->validations?->toArray(),
            'registryAccounts' => $this->registryAccounts?->toArray(),
            'disclosedFields' => $this->disclosedFields,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
