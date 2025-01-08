<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\ExchangeRates;
use RealtimeRegister\Domain\Transaction;
use RealtimeRegister\Domain\TransactionCollection;

final class FinancialApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/transactions/get
     *
     * @param int $transactionId
     *
     * @throws \Exception
     *
     * @return Transaction
     */
    public function getTransaction(int $transactionId): Transaction
    {
        $response = $this->client->get(sprintf('v2/billing/financialtransactions/%d', $transactionId));
        return Transaction::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/transactions/list
     *
     * @param int|null              $limit
     * @param int|null              $offset
     * @param string|null           $search
     * @param array<string, string> $parameters
     *
     * @return TransactionCollection
     */
    public function listTransactions(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): TransactionCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('v2/billing/financialtransactions', $query);

        return TransactionCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/exchangerates */
    public function exchangeRates(string $currency): ExchangeRates
    {
        $response = $this->client->get("v2/exchangerates/{$currency}");
        return ExchangeRates::fromArray($response->json());
    }
}
