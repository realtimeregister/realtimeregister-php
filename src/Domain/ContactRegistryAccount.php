<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class ContactRegistryAccount implements DomainObjectInterface
{
    public string $id;

    public ?string $authCode;

    /** @var string[]|null */
    public ?array $intendedUsage;

    public string $registry;

    public string $registryAccount;

    public ?string $roid;

    private function __construct(
        string $id,
        ?string $authCode,
        ?array $intendedUsage,
        string $registry,
        string $registryAccount,
        ?string $roid
    ) {
        $this->id = $id;
        $this->authCode = $authCode;
        $this->intendedUsage = $intendedUsage;
        $this->registry = $registry;
        $this->registryAccount = $registryAccount;
        $this->roid = $roid;
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'authCode' => $this->authCode,
            'intendedUsage' => $this->intendedUsage,
            'registry' => $this->registry,
            'registryAccount' => $this->registryAccount,
            'roid' => $this->roid,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): ContactRegistryAccount
    {
        return new ContactRegistryAccount(
            $json['id'],
            $json['authCode'] ?? null,
            $json['intendedUsage'] ?? null,
            $json['registry'],
            $json['registryAccount'],
            $json['roid'] ?? null
        );
    }
}
