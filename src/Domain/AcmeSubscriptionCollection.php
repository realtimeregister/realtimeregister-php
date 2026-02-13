<?php

namespace RealtimeRegister\Domain;

class AcmeSubscriptionCollection extends AbstractCollection
{

    /** @var AcmeSubscription[] */
    public array $entities;

    public function offsetGet($offset): ?AcmeSubscription
    {
        return $this->entities[$offset] ?? null;
    }

    /**
     * @throws \Exception
     */
    public static function parseChild(array $json): AcmeSubscription
    {
        return AcmeSubscription::fromArray($json);
    }
}
