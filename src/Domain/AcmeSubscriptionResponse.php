<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class AcmeSubscriptionResponse implements DomainObjectInterface
{
    private function __construct(
        public ?int $id,
        public string $directoryUrl,
        public string $accountKey,
        public string $hmacKey
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'id' => $this->id,
                'directoryUrl' => $this->directoryUrl,
                'accountKey' => $this->accountKey,
                'hmacKey' => $this->hmacKey,
            ],
            fn ($value) => ! is_null($value)
        );
    }

    public static function fromArray(array $json): AcmeSubscriptionResponse
    {
        return new AcmeSubscriptionResponse(
            $json['id'],
            $json['directoryUrl'],
            $json['accountKey'],
            $json['hmacKey']
        );
    }
}
