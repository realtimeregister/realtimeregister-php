<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\AccountCollection;
use RealtimeRegister\Domain\PriceChangesCollection;
use RealtimeRegister\Domain\PriceCollection;
use RealtimeRegister\Domain\PromoCollection;

final class CustomersApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/customers/pricelist */
    public function priceList(string $customer): PriceCollection
    {
        $response = $this->client->get(sprintf('v2/customers/%s/pricelist', urlencode($customer)));
        return PriceCollection::fromArray($response->json()['prices']);
    }

    /** @see https://dm.realtimeregister.com/docs/api/customers/pricelist#priceChanges */
    public function priceChangesList(string $customer): PriceChangesCollection
    {
        $response = $this->client->get(sprintf('v2/customers/%s/pricelist', urlencode($customer)));
        return PriceChangesCollection::fromArray($response->json()['priceChanges']);
    }

    /* @see https://dm.realtimeregister.com/docs/api/customers/pricelist#promos  */
    public function promoList(string $customer): PromoCollection
    {
        $response = $this->client->get(sprintf('v2/customers/%s/pricelist', urlencode($customer)));
        return PromoCollection::fromArray($response->json()['promos']);
    }

    /* @see https://dm.realtimeregister.com/docs/api/customers/credits */
    public function credits(string $customer): AccountCollection
    {
        $response = $this->client->get(sprintf('v2/customers/%s/credit', urlencode($customer)));
        return AccountCollection::fromArray($response->json()['accounts']);
    }
}
