<?php

namespace RealtimeRegister\Domain;

class AcmeSubscriptionResponse implements DomainObjectInterface
{

    public ?int $id;

    public string $directoryUrl;

    public string $accountKey;

    public string $hmacKey;

    private function __construct(?int $id, string $directoryUrl, string $accountKey, string $hmacKey) {
        $this->id = $id;
        $this->directoryUrl = $directoryUrl;
        $this->accountKey = $accountKey;
        $this->hmacKey = $hmacKey;
    }

    public function toArray(): array
    {
        return array_filter(
            ['id' => $this->id,
                'directoryUrl' => $this->directoryUrl,
                'accountKey' => $this->accountKey,
                'hmacKey' => $this->hmacKey
            ], fn($value) => !is_null($value)
        );
    }

    public static function fromArray(array $json) : AcmeSubscriptionResponse
    {
        return new AcmeSubscriptionResponse(
            $json['id'],
            $json['directoryUrl'],
            $json['accountKey'],
            $json['hmacKey']
        );
    }
}
