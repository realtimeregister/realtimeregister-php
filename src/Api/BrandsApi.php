<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use DateTime;
use RealtimeRegister\Domain\Brand;
use RealtimeRegister\Domain\BrandCollection;
use RealtimeRegister\Domain\Enum\TemplateNameEnum;
use RealtimeRegister\Domain\Template;
use RealtimeRegister\Domain\TemplateCollection;
use RealtimeRegister\Domain\TemplatePreview;
use RealtimeRegister\Exceptions\InvalidArgumentException;

final class BrandsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/brands/get */
    public function get(string $customer, string $handle): Brand
    {
        $response = $this->client->get(sprintf('v2/customers/%s/brands/%s', urlencode($customer), urlencode($handle)));
        return Brand::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/brands/list */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): BrandCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get(sprintf('v2/customers/%s/brands', urlencode($customer)), $query);
        return BrandCollection::fromArray($response->json());
    }

    public function export(
        string $customer,
        array $parameters = []
    ): array {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get(sprintf('v2/customers/%s/brands', urlencode($customer)), $query);
        return $response->json()['entities'];
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/brands/create
     *
     * @param string[] $addressLine;
     */
    public function create(
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
        ?string $url,
        string $voice,
        ?string $fax,
        ?string $privacyContact,
        ?string $abuseContact,
        DateTime $createdDate,
        ?DateTime $updatedDate,
        ?bool $hideOptionalTerms
    ): void {
        $payload = [
            'locale' => $locale,
            'organization' => $organization,
            'addressLine' =>  $addressLine,
            'postalCode' => $postalCode,
            'city' =>  $city,
            'country' =>  $country,
            'email' =>  $email,
            'voice' =>  $voice,
            'createdDate' =>  $createdDate,
        ];

        if ($state) {
            $payload['state'] = $state;
        }
        if ($url) {
            $payload['url'] = $url;
        }
        if ($fax) {
            $payload['fax'] = $fax;
        }
        if ($privacyContact) {
            $payload['privacyContact'] = $privacyContact;
        }
        if ($abuseContact) {
            $payload['abuseContact'] = $abuseContact;
        }
        if ($updatedDate) {
            $payload['updatedDate'] = $updatedDate;
        }
        if (isset($hideOptionalTerms)) {
            $payload['hideOptionalTerms'] = $hideOptionalTerms;
        }

        $this->client->post(sprintf('v2/customers/%s/brands/%s', urlencode($customer), urlencode($handle)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/brands/update
     *
     * @param string[]|null $addressLine;
     */
    public function update(
        string $customer,
        string $handle,
        ?string $locale = null,
        ?string $organization = null,
        ?array $addressLine = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $state = null,
        ?string $country = null,
        ?string $email = null,
        ?string $url = null,
        ?string $voice = null,
        ?string $fax = null,
        ?string $privacyContact = null,
        ?string $abuseContact = null,
        ?DateTime $createdDate = null,
        ?DateTime $updatedDate = null,
        ?bool $hideOptionalTerms = false
    ): void {
        $payload = [];

        if ($locale) {
            $payload['locale'] = $locale;
        }

        if ($organization) {
            $payload['organization'] = $organization;
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

        if ($state) {
            $payload['state'] = $state;
        }

        if ($country) {
            $payload['country'] = $country;
        }

        if ($email) {
            $payload['email'] = $email;
        }

        if ($url) {
            $payload['url'] = $url;
        }

        if ($voice) {
            $payload['voice'] = $voice;
        }

        if ($fax) {
            $payload['fax'] = $fax;
        }

        if ($privacyContact) {
            $payload['privacyContact'] = $privacyContact;
        }

        if ($abuseContact) {
            $payload['abuseContact'] = $abuseContact;
        }

        if ($createdDate) {
            $payload['createdDate'] = $createdDate;
        }

        if ($updatedDate) {
            $payload['updatedDate'] = $updatedDate;
        }

        if (isset($hideOptionalTerms)) {
            $payload['hideOptionalTerms'] = $hideOptionalTerms;
        }

        $this->client->post(sprintf('v2/customers/%s/brands/%s/update', urlencode($customer), urlencode($handle)), $payload);
    }

    /* @see https://dm.realtimeregister.com/docs/api/brands/delete */
    public function delete(string $customer, string $handle): void
    {
        $this->client->delete("v2/customers/{$customer}/brands/{$handle}");
    }

    /* @see https://dm.realtimeregister.com/docs/api/brands/templates/get */
    public function getTemplate(string $customer, string $brand, string $name): Template
    {
        TemplateNameEnum::validate($name);

        return Template::fromArray($this->client->get(sprintf('v2/customers/%s/brands/%s/templates/%s', urlencode($customer), urlencode($brand), urlencode($name)))->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/brands/templates/list */
    public function listTemplates(
        string $customer,
        string $brand,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): TemplateCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get(sprintf('v2/customers/%s/brands/%s/templates', urlencode($customer), urlencode($brand)), $query);
        return TemplateCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/brands/templates/update */
    public function updateTemplate(
        string $customer,
        string $brand,
        string $name,
        ?string $subject = null,
        ?string $text = null,
        ?string $html = null
    ): void {
        $payload = [];

        if ($subject) {
            $payload['subject'] = $subject;
        }
        if ($text) {
            $payload['text'] = $text;
        }
        if ($html) {
            $payload['html'] = $html;
        }

        $this->client->post(sprintf('v2/customers/%s/brands/%s/templates/%s/update', urlencode($customer), urlencode($brand), urlencode($name)), $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/brands/templates/preview
     *
     * @throws InvalidArgumentException
     */
    public function previewTemplate(string $customer, string $brand, string $name, ?string $contexts = null): TemplatePreview
    {
        $invalidTemplateNamesForPreview = [
            TemplateNameEnum::TEMPLATE_NAME_EMAIL_HEADER,
            TemplateNameEnum::TEMPLATE_NAME_EMAIL_FOOTER,
            TemplateNameEnum::TEMPLATE_NAME_WEB_HEADER,
            TemplateNameEnum::TEMPLATE_NAME_WEB_FOOTER,
        ];
        if (in_array($name, $invalidTemplateNamesForPreview)) {
            throw new InvalidArgumentException(sprintf(
                'Template name %s not available for preview. Not available names: (%s)',
                $name,
                implode(', ', $invalidTemplateNamesForPreview)
            ));
        }

        $payload = [];
        if ($contexts) {
            $payload['contexts'] = $contexts;
        }

        return TemplatePreview::fromArray(
            $this->client->get(sprintf('v2/customers/%s/brands/%s/templates/%s/preview', urlencode($customer), urlencode($brand), urlencode($name)), $payload)->json()
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/brands/locales
     */
    public function listLocales() {
        $this->client->get('v2/brands/locales');
    }
}
