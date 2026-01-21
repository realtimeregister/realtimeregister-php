<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class RegistryAccount implements DomainObjectInterface
{
    public string $allowDesignatedAgent;

    public ?int $ianaId;

    public string $loginName;

    public string $name;

    public string $owner;

    public bool $registrantChangeApprovalRequired;

    public bool $registrantChangeTransferLock;

    public ?string $registrarIdentifier;

    public ?string $registrarSignature;

    public string $registry;

    public ?string $renamedHostDomain;

    public bool $sendErrpNotifications;

    public bool $sendWdrpNotifications;

    public ?array $tlds;

    public ?string $validationCategory;

    private function __construct(
        string $allowDesignatedAgent,
        ?int $ianaId,
        string $loginName,
        string $name,
        string $owner,
        bool $registrantChangeApprovalRequired,
        bool $registrantChangeTransferLock,
        ?string $registrarIdentifier,
        ?string $registrarSignature,
        string $registry,
        ?string $renamedHostDomain,
        bool $sendErrpNotifications,
        bool $sendWdrpNotifications,
        ?array $tlds,
        ?string $validationCategory
    ) {
        $this->allowDesignatedAgent = $allowDesignatedAgent;
        $this->ianaId = $ianaId;
        $this->loginName = $loginName;
        $this->name = $name;
        $this->owner = $owner;
        $this->registrantChangeApprovalRequired = $registrantChangeApprovalRequired;
        $this->registrantChangeTransferLock = $registrantChangeTransferLock;
        $this->registrarIdentifier = $registrarIdentifier;
        $this->registrarSignature = $registrarSignature;
        $this->registry = $registry;
        $this->renamedHostDomain = $renamedHostDomain;
        $this->sendErrpNotifications = $sendErrpNotifications;
        $this->sendWdrpNotifications = $sendWdrpNotifications;
        $this->tlds = $tlds;
        $this->validationCategory = $validationCategory;
    }

    public function toArray(): array
    {
        return array_filter([
            'allowDesignatedAgent' => $this->allowDesignatedAgent,
            'ianaId' => $this->ianaId,
            'loginName' => $this->loginName,
            'name' => $this->name,
            'owner' => $this->owner,
            'registrantChangeApprovalRequired' => $this->registrantChangeApprovalRequired,
            'registrantChangeTransferLock' => $this->registrantChangeTransferLock,
            'registrarIdentifier' => $this->registrarIdentifier,
            'registrarSignature' => $this->registrarSignature,
            'registry' => $this->registry,
            'renamedHostDomain' => $this->renamedHostDomain,
            'sendErrpNotifications' => $this->sendErrpNotifications,
            'sendWdrpNotifications' => $this->sendWdrpNotifications,
            'tlds' => $this->tlds,
            'validationCategory' => $this->validationCategory,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): RegistryAccount
    {
        return new RegistryAccount(
            $json['allowDesignatedAgent'],
            $json['ianaId'] ?? null,
            $json['loginName'],
            $json['name'],
            $json['owner'],
            $json['registrantChangeApprovalRequired'],
            $json['registrantChangeTransferLock'],
            $json['registrarIdentifier'] ?? null,
            $json['registrarSignature'] ?? null,
            $json['registry'],
            $json['renamedHostDomain'] ?? null,
            $json['sendErrpNotifications'],
            $json['sendWdrpNotifications'],
            $json['tlds'] ?? null,
            $json['validationCategory'] ?? null
        );
    }
}
