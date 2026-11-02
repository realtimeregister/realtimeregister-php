<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use DateTimeInterface;
use InvalidArgumentException;
use RealtimeRegister\Domain\Contact;
use RealtimeRegister\Domain\ContactCollection;
use RealtimeRegister\Domain\Country;
use RealtimeRegister\Domain\CountryCollection;
use RealtimeRegister\Domain\Enum\VerificationClaimEnum;
use RealtimeRegister\Domain\Enum\VerificationMethodEnum;
use RealtimeRegister\Domain\Enum\VerificationProofEnum;
use RealtimeRegister\Support\RealtimeRegisterResponse;

final class ContactsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/contacts/list */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ContactCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get(sprintf('v2/customers/%s/contacts', urlencode($customer)), $query);
        return ContactCollection::fromArray($response->json());
    }

    public function export(string $customer, array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get(sprintf('v2/customers/%s/contacts', urlencode($customer)), $query);
        return $response->json()['entities'];
    }

    /* @see https://dm.realtimeregister.com/docs/api/contacts/get */
    public function get(string $customer, string $handle): Contact
    {
        $response = $this->client->get(sprintf('v2/customers/%s/contacts/%s', urlencode($customer), urlencode($handle)));
        return Contact::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/create
     *
     * Each validation is an array with the keys category, termsVersion, validatedBy (IP address) and optionally
     * validatedOn (DateTimeInterface|string). Passing validations requires the CONTACT_VALIDATION permission.
     *
     * Each verification is an array with the keys verificationDate (DateTimeInterface|string), method, proof,
     * claims (string[]) and externalId. Passing verifications requires the CONTACT_VERIFICATION permission.
     *
     * @param string[]                   $addressLine
     * @param array<array<string,mixed>> $validations
     * @param array<array<string,mixed>> $verifications
     */
    public function create(
        string $customer,
        string $handle,
        string $name,
        array $addressLine,
        string $postalCode,
        string $city,
        string $country,
        string $email,
        string $voice,
        ?string $brand = null,
        ?string $organization = null,
        ?string $state = null,
        ?string $fax = null,
        ?array $disclosedFields = null,
        ?array $validations = null,
        ?array $verifications = null
    ): void {
        $payload = [
            'customer' => $customer,
            'handle' => $handle,
            'name' => $name,
            'addressLine' => $addressLine,
            'postalCode' => $postalCode,
            'city' => $city,
            'country' => $country,
            'email' => $email,
            'voice' => $voice,
        ];
        if ($brand) {
            $payload['brand'] = $brand;
        }
        if ($organization) {
            $payload['organization'] = $organization;
        }
        if ($state) {
            $payload['state'] = $state;
        }
        if ($fax) {
            $payload['fax'] = $fax;
        }
        if ($disclosedFields) {
            $payload['disclosedFields'] = $disclosedFields;
        }
        if ($validations) {
            $payload['validations'] = $this->processValidations($validations);
        }
        if ($verifications) {
            $payload['verifications'] = $this->processVerifications($verifications);
        }

        $this->client->post(sprintf('v2/customers/%s/contacts/%s', urlencode($customer), urlencode($handle)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/create
     *
     * Each validation is an array with the keys category, termsVersion, validatedBy (IP address) and optionally
     * validatedOn (DateTimeInterface|string). Passing validations requires the CONTACT_VALIDATION permission.
     *
     * Each verification is an array with the keys verificationDate (DateTimeInterface|string), method, proof,
     * claims (string[]) and externalId. Passing verifications requires the CONTACT_VERIFICATION permission.
     *
     * @param string[]                   $addressLine
     * @param array<array<string,mixed>> $validations
     * @param array<array<string,mixed>> $verifications
     */
    public function update(
        string $customer,
        string $handle,
        ?string $name = null,
        ?array $addressLine = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        ?string $voice = null,
        ?string $brand = null,
        ?string $organization = null,
        ?string $state = null,
        ?string $fax = null,
        ?array $disclosedFields = null,
        ?array $validations = null,
        ?array $verifications = null
    ): RealtimeRegisterResponse {
        $payload = [
            'customer' => $customer,
            'handle' => $handle,
        ];

        if ($name) {
            $payload['name'] = $name;
        }
        if ($addressLine) {
            $payload['addressLine'] = $addressLine;
        }
        if ($postalCode) {
            $payload['postalCode'] = $postalCode;
        }
        if ($city) {
            $payload['city'] = $city;
        }
        if ($country) {
            $payload['country'] = $country;
        }
        if ($email) {
            $payload['email'] = $email;
        }
        if ($voice) {
            $payload['voice'] = $voice;
        }
        if ($brand) {
            $payload['brand'] = $brand;
        }
        if (is_string($organization)) {
            $payload['organization'] = $organization;
        }
        if (is_string($state)) {
            $payload['state'] = $state;
        }
        if (is_string($fax)) {
            $payload['fax'] = $fax;
        }
        if ($disclosedFields) {
            $payload['disclosedFields'] = $disclosedFields;
        }
        if ($validations) {
            $payload['validations'] = $this->processValidations($validations);
        }
        if ($verifications) {
            $payload['verifications'] = $this->processVerifications($verifications);
        }

        return $this->client->post(sprintf('v2/customers/%s/contacts/%s/update', urlencode($customer), urlencode($handle)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/validate
     *
     * @param array<string> $categories Must be one of ("General", "IisNu", "IisSe", "Esnic", "Nominet", "DkHostmaster")
     */
    public function validate(string $customer, string $handle, array $categories): void
    {
        foreach ($categories as $category) {
            $categoriesAllowed = ['General', 'IisNu', 'IisSe', 'Esnic', 'Nominet', 'DkHostmaster'];

            if (! in_array($category, $categoriesAllowed)) {
                $imploded = implode(',', $categoriesAllowed);
                throw new InvalidArgumentException("Provided Category not in array: {$category} Valid options: {$imploded}");
            }
        }

        $this->client->post(sprintf('v2/customers/%s/contacts/%s/validate', urlencode($customer), urlencode($handle)), [
            'categories' => $categories,
        ]);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/split
     *
     * @param array<string>|null $registries
     */
    public function split(string $customer, string $handle, string $newHandle, ?array $registries = null): void
    {
        $payload = ['newHandle' => $newHandle];

        if ($registries) {
            $payload['registries'] = $registries;
        }

        $this->client->post(sprintf('v2/customers/%s/contacts/%s/split', urlencode($customer), urlencode($handle)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/delete
     */
    public function delete(string $customer, string $handle): void
    {
        $this->client->delete(sprintf('v2/customers/%s/contacts/%s', urlencode($customer), urlencode($handle)));
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/properties/add
     *
     * @param array<string, string> $properties
     * @param string|null           $intendedUsage Must be one of ("REGISTRANT","ADMIN","BILLING","TECH").
     */
    public function addProperties(string $customer, string $handle, string $registry, array $properties, ?string $intendedUsage = null): void
    {
        $payload = ['properties' => $properties];
        if ($intendedUsage) {
            $usages = ['REGISTRANT', 'ADMIN', 'BILLING', 'TECH'];

            if (! in_array($intendedUsage, $usages)) {
                $imploded = implode(',', $usages);
                throw new InvalidArgumentException("Provided Category not in array: {$intendedUsage} Valid options: {$imploded}");
            }

            $payload['intendedUsage'] = $intendedUsage;
        }
        $this->client->post(sprintf('v2/customers/%s/contacts/%s/%s', urlencode($customer), urlencode($handle), urlencode($registry)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/properties/update
     *
     * @param array<string, string> $properties
     */
    public function updateProperties(string $customer, string $handle, string $registry, array $properties): void
    {
        $this->client->post(sprintf('v2/customers/%s/contacts/%s/%s/update', urlencode($customer), urlencode($handle), urlencode($registry)), [
            'properties' => empty($properties) ? null : $properties,
        ]);
    }

    /* @see https://dm.realtimeregister.com/docs/api/countries/get */
    public function getCountry(string $country): Country
    {
        return Country::fromArray($this->client->get(sprintf('v2/countries/%s', urlencode($country)))->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/contacts/list */
    public function listCountries(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): CountryCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/countries', $query);
        return CountryCollection::fromArray($response->json());
    }

    private function processValidations(array $validations): array
    {
        return array_map(function (array $validation): array {
            $this->assertRequiredFields('Validation', $validation, ['category', 'termsVersion', 'validatedBy']);

            if (filter_var($validation['validatedBy'], FILTER_VALIDATE_IP) === false) {
                throw new InvalidArgumentException("Validation validatedBy is not a valid IP address: {$validation['validatedBy']}");
            }

            $payload = [
                'category' => $validation['category'],
                'termsVersion' => (string) $validation['termsVersion'],
                'validatedBy' => $validation['validatedBy'],
            ];
            if (isset($validation['validatedOn'])) {
                $payload['validatedOn'] = $this->formatDate($validation['validatedOn']);
            }

            return $payload;
        }, array_values($validations));
    }

    private function processVerifications(array $verifications): array
    {
        return array_map(function (array $verification): array {
            $this->assertRequiredFields('Verification', $verification, ['verificationDate', 'method', 'proof', 'claims', 'externalId']);

            VerificationMethodEnum::validate($verification['method']);
            VerificationProofEnum::validate($verification['proof']);
            foreach ($verification['claims'] as $claim) {
                VerificationClaimEnum::validate($claim);
            }

            return [
                'verificationDate' => $this->formatDate($verification['verificationDate']),
                'method' => $verification['method'],
                'proof' => $verification['proof'],
                'claims' => $verification['claims'],
                'externalId' => $verification['externalId'],
            ];
        }, array_values($verifications));
    }

    /** @param string[] $fields */
    private function assertRequiredFields(string $type, array $data, array $fields): void
    {
        foreach ($fields as $field) {
            if (! isset($data[$field])) {
                throw new InvalidArgumentException("{$type} is missing required field: {$field}");
            }
        }
    }

    /** @param DateTimeInterface|string $date */
    private function formatDate($date): string
    {
        return $date instanceof DateTimeInterface ? $date->format(DateTimeInterface::ATOM) : $date;
    }
}
