<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use InvalidArgumentException;
use RealtimeRegister\Domain\DnsTemplate;
use RealtimeRegister\Domain\DnsTemplateCollection;
use RealtimeRegister\Domain\DomainZoneRecordCollection;
use Webmozart\Assert\Assert;

final class DnsTemplatesApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/list
     *
     * @param string      $customer
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     * @param array|null  $parameters
     *
     * @throws InvalidArgumentException
     *
     * @return DnsTemplateCollection
     */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DnsTemplateCollection {
        $this->validateCustomerHandle($customer);
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }
        if (! is_null($search)) {
            $query['q'] = $search;
        }
        if (! is_null($parameters)) {
            $query = array_merge($parameters, $query);
        }

        $response = $this->client->get(
            sprintf('v2/customers/%s/dnstemplates', urlencode($customer)),
            $query
        );
        return DnsTemplateCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/get
     *
     * @param string $customer
     * @param string $name     Name of the template
     *
     * @throws InvalidArgumentException
     *
     * @return DnsTemplate
     */
    public function get(string $customer, string $name): DnsTemplate
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $response = $this->client->get(
            sprintf('v2/customers/%s/dnstemplates/%s', urlencode($customer), urlencode($name))
        );
        return DnsTemplate::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/create
     *
     * @param string                      $customer
     * @param string                      $name       Name of the template
     * @param string                      $hostMaster
     * @param int                         $refresh
     * @param int                         $retry
     * @param int                         $expire
     * @param int                         $ttl
     * @param ?DomainZoneRecordCollection $records
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function create(
        string $customer,
        string $name,
        string $hostMaster,
        int $refresh,
        int $retry,
        int $expire,
        int $ttl,
        ?DomainZoneRecordCollection $records = null
    ): void {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $payload = [
            'hostMaster' => $hostMaster,
            'refresh'    => $refresh,
            'retry'      => $retry,
            'expire'     => $expire,
            'ttl'        => $ttl,
        ];
        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf('v2/customers/%s/dnstemplates/%s', urlencode($customer), urlencode($name)),
            $payload
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/update
     *
     * @param string                      $customer
     * @param string                      $name       Name of the template
     * @param string                      $hostMaster
     * @param int                         $refresh
     * @param int                         $retry
     * @param int                         $expire
     * @param int                         $ttl
     * @param ?DomainZoneRecordCollection $records
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function update(
        string $customer,
        string $name,
        string $hostMaster,
        int $refresh,
        int $retry,
        int $expire,
        int $ttl,
        ?DomainZoneRecordCollection $records = null
    ): void {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $payload = [
            'hostMaster' => $hostMaster,
            'refresh'    => $refresh,
            'retry'      => $retry,
            'expire'     => $expire,
            'ttl'        => $ttl,
        ];
        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf('v2/customers/%s/dnstemplates/%s/update', urlencode($customer), urlencode($name)),
            $payload
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/delete
     *
     * @param string $customer
     * @param string $name     Name of the template
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function delete(string $customer, string $name): void
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $this->client->delete(
            sprintf('v2/customers/%s/dnstemplates/%s', urlencode($customer), urlencode($name))
        );
    }

    /**
     * Validate customer handle input.
     *
     * @param string $customer
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    private function validateCustomerHandle(string $customer): void
    {
        Assert::lengthBetween($customer, 3, 40, 'Customer handle should be between 3 and 40 characters');
        Assert::regex($customer, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid customer handle, allowed characters: a-z A-Z 0-9 - _ @ .');
    }

    /**
     * Validate template name input.
     *
     * @param string $name
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    private function validateTemplateName(string $name): void
    {
        Assert::lengthBetween($name, 3, 40, 'Template name should be between 3 and 40 characters');
        Assert::regex($name, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid template name, allowed characters: a-z A-Z 0-9 - _ @ .');
    }
}
