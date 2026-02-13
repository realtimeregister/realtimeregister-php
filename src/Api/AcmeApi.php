<?php declare(strict_types=1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\AcmeSubscription;
use RealtimeRegister\Domain\AcmeSubscriptionCollection;
use RealtimeRegister\Domain\AcmeSubscriptionResponse;
use RealtimeRegister\Domain\Approver;
use RealtimeRegister\Domain\DomainQuote;

final class AcmeApi extends AbstractApi
{

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/get */
    public function get(int $acmeSubscriptionId): AcmeSubscription
    {
        $response = $this->client->get(sprintf('v2/ssl/acme/%s', $acmeSubscriptionId));
        return AcmeSubscription::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/list */
    public function list(
        ?int    $limit = null,
        ?int    $offset = null,
        ?string $search = null,
        ?array  $parameters = null
    ): AcmeSubscriptionCollection
    {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/ssl/acme', $query);
        return AcmeSubscriptionCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/create */
    public function create(
        string    $customer,
        string    $product,
        int       $period,
        ?array    $domainNames = null,
        ?string   $organization = null,
        ?string   $country = null,
        ?string   $state = null,
        ?string   $address = null,
        ?string   $postalCode = null,
        ?string   $city = null,
        ?bool     $autoRenew = null,
        ?int      $certValidity = null,
        ?Approver $approver = null,
        bool      $isQuote = false
    ): AcmeSubscriptionResponse | DomainQuote
    {
        $payload = array_filter([
            'customer' => $customer,
            'product' => $product,
            'domainNames' => $domainNames,
            'organization' => $organization,
            'country' => $country,
            'state' => $state,
            'address' => $address,
            'postalCode' => $postalCode,
            'city' => $city,
            'autoRenew' => $autoRenew,
            'period' => $period,
            'certValidity' => $certValidity,
            'approver' => $approver?->toArray()
        ], fn($value) => !is_null($value));

        $response = $this->client->post('v2/ssl/acme', $payload, [
            'quote' => $isQuote ? 'true' : 'false',
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return AcmeSubscriptionResponse::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/update */
    public function update(
        int       $acmeSubscriptionId,
        ?int      $period = null,
        ?array    $domainNames = null,
        ?string   $organization = null,
        ?string   $country = null,
        ?string   $state = null,
        ?string   $address = null,
        ?string   $postalCode = null,
        ?string   $city = null,
        ?bool     $autoRenew = null,
        ?Approver $approver = null,
        bool     $isQuote = false
    ): ?DomainQuote
    {
        $payload = array_filter([
            'domainNames' => $domainNames,
            'organization' => $organization,
            'country' => $country,
            'state' => $state,
            'address' => $address,
            'postalCode' => $postalCode,
            'city' => $city,
            'autoRenew' => $autoRenew,
            'period' => $period,
            'approver' => $approver?->toArray()
        ], fn($value) => !is_null($value));

        $response = $this->client->post(sprintf('v2/ssl/acme/%s/update', $acmeSubscriptionId), $payload, [
            'quote' => $isQuote ? 'true' : 'false',
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return null;
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/renew */
    public function renew(
        int  $acmeSubscriptionId,
        int  $period,
        bool $isQuote = false
    ): ?DomainQuote
    {
        $payload = ['period' => $period];
        $response = $this->client->post(sprintf('v2/ssl/acme/%s/renew', $acmeSubscriptionId), $payload, [
            'quote' => $isQuote ? 'true' : 'false',
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return null;
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/delete */
    public function delete(int $acmeSubscriptionId,): void
    {
        $this->client->delete(sprintf('v2/ssl/acme/%s', $acmeSubscriptionId));
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/acme/credentials */
    public function credentials(int $acmeSubscriptionId): AcmeSubscriptionResponse {
        $response = $this->client->post(sprintf('v2/ssl/acme/%s/credentials', $acmeSubscriptionId));
        return AcmeSubscriptionResponse::fromArray($response->json());
    }
}
