<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

use RealtimeRegister\Domain\Enum\DomainDesignatedAgentEnum;
use RealtimeRegister\Domain\Enum\DomainFeatureEnum;
use RealtimeRegister\Domain\Enum\DomainPossibleClientDomainStatusEnum;
use RealtimeRegister\Domain\Enum\GDPRCategoryEnum;
use RealtimeRegister\Domain\Enum\PremiumSupportEnum;
use RealtimeRegister\Domain\Enum\WhoisExposureEnum;
use Webmozart\Assert\Assert;

final class TLDMetaData implements DomainObjectInterface
{
    /** @var array<int> */
    public array $createDomainPeriods;

    /** @var array<int> */
    public array $renewDomainPeriods;

    /** @var array<int> */
    public array $autoRenewDomainPeriods;

    /** @var array<int>|null */
    public ?array $transferDomainPeriods;

    public ?int $redemptionPeriod;

    public ?int $pendingDeletePeriod;

    public ?int $addGracePeriod;

    public ?int $renewGracePeriod;

    public ?int $autoRenewGracePeriod;

    public ?int $transferGracePeriod;

    public ?int $expiryDateOffset;

    public bool $transferFOA;

    public bool $adjustableAuthCode;

    public bool $customAuthcodeSupport;

    public bool $transferSupportsAuthcode;

    public bool $transferRequiresAuthcode;

    public bool $creationRequiresPreValidation;

    public ?string $zoneCheck;

    public ?array $possibleClientDomainStatuses;

    public ?int $allowedDnssecRecords;

    public ?array $allowedDnssecAlgorithms;

    public ?string $validationCategory;

    public array $featuresAvailable;

    public bool $registrantChangeApprovalRequired;

    public ?string $allowDesignatedAgent;

    public ?string $jurisdiction;

    public ?string $termsOfService;

    public ?string $privacyPolicy;

    public string $whoisExposure;

    public string $gdprCategory;

    public string $premiumSupport;

    public DomainSyntax $domainSyntax;

    public Nameservers $nameservers;

    public Registrant $registrant;

    public ContactsConstraint $adminContacts;

    public ContactsConstraint $billingContacts;

    public ContactsConstraint $techContacts;

    public ?ContactPropertyCollection $contactProperties;

    public ?LaunchPhaseCollection $launchPhases;

    private function __construct(
        array $createDomainPeriods,
        array $renewDomainPeriods,
        array $autoRenewDomainPeriods,
        bool $transferFOA,
        bool $adjustableAuthCode,
        bool $customAuthcodeSupport,
        bool $transferSupportsAuthcode,
        bool $transferRequiresAuthcode,
        bool $creationRequiresPreValidation,
        array $featuresAvailable,
        bool $registrantChangeApprovalRequired,
        string $whoisExposure,
        string $gdprCategory,
        DomainSyntax $domainSyntax,
        Nameservers $nameservers,
        Registrant $registrant,
        ContactsConstraint $adminContacts,
        ContactsConstraint $billingContacts,
        ContactsConstraint $techContacts,
        ?ContactPropertyCollection $contactProperties,
        ?LaunchPhaseCollection $launchPhases,
        ?int $redemptionPeriod,
        ?int $pendingDeletePeriod,
        ?int $addGracePeriod,
        ?int $renewGracePeriod,
        ?int $autoRenewGracePeriod,
        ?int $transferGracePeriod,
        ?int $expiryDateOffset,
        ?array $transferDomainPeriods,
        ?array $possibleClientDomainStatuses,
        ?int $allowedDnssecRecords,
        ?array $allowedDnssecAlgorithms,
        ?string $validationCategory,
        ?string $zoneCheck,
        ?string $allowDesignatedAgent,
        ?string $jurisdiction,
        ?string $termsOfService,
        ?string $privacyPolicy,
        string $premiumSupport
    ) {
        $this->createDomainPeriods = $createDomainPeriods;
        $this->renewDomainPeriods = $renewDomainPeriods;
        $this->autoRenewDomainPeriods = $autoRenewDomainPeriods;
        $this->transferFOA = $transferFOA;
        $this->adjustableAuthCode = $adjustableAuthCode;
        $this->customAuthcodeSupport = $customAuthcodeSupport;
        $this->transferSupportsAuthcode = $transferSupportsAuthcode;
        $this->transferRequiresAuthcode = $transferRequiresAuthcode;
        $this->creationRequiresPreValidation = $creationRequiresPreValidation;
        $this->featuresAvailable = $featuresAvailable;
        $this->registrantChangeApprovalRequired = $registrantChangeApprovalRequired;
        $this->whoisExposure = $whoisExposure;
        $this->gdprCategory = $gdprCategory;
        $this->domainSyntax = $domainSyntax;
        $this->nameservers = $nameservers;
        $this->registrant = $registrant;
        $this->adminContacts = $adminContacts;
        $this->billingContacts = $billingContacts;
        $this->techContacts = $techContacts;
        $this->contactProperties = $contactProperties;
        $this->launchPhases = $launchPhases;
        $this->redemptionPeriod = $redemptionPeriod;
        $this->pendingDeletePeriod = $pendingDeletePeriod;
        $this->addGracePeriod = $addGracePeriod;
        $this->renewGracePeriod = $renewGracePeriod;
        $this->autoRenewGracePeriod = $autoRenewGracePeriod;
        $this->transferGracePeriod = $transferGracePeriod;
        $this->expiryDateOffset = $expiryDateOffset;
        $this->transferDomainPeriods = $transferDomainPeriods;
        $this->possibleClientDomainStatuses = $possibleClientDomainStatuses;
        $this->allowedDnssecRecords = $allowedDnssecRecords;
        $this->allowedDnssecAlgorithms = $allowedDnssecAlgorithms;
        $this->validationCategory = $validationCategory;
        $this->zoneCheck = $zoneCheck;
        $this->allowDesignatedAgent = $allowDesignatedAgent;
        $this->jurisdiction = $jurisdiction;
        $this->termsOfService = $termsOfService;
        $this->privacyPolicy = $privacyPolicy;
        $this->premiumSupport = $premiumSupport;
    }

    public static function fromArray(array $json): TLDMetaData
    {
        if (isset($json['possibleClientDomainStatuses'])) {
            Assert::isArray($json['possibleClientDomainStatuses']);
            foreach ($json['possibleClientDomainStatuses'] as $status) {
                DomainPossibleClientDomainStatusEnum::validate($status);
            }
        }
        foreach ($json['featuresAvailable'] as $feature) {
            DomainFeatureEnum::validate($feature);
        }
        if (isset($json['allowDesignatedAgent'])) {
            DomainDesignatedAgentEnum::validate($json['allowDesignatedAgent']);
        }
        WhoisExposureEnum::validate($json['whoisExposure']);
        GDPRCategoryEnum::validate($json['gdprCategory']);
        PremiumSupportEnum::validate($json['premiumSupport']);

        return new TLDMetaData(
            $json['createDomainPeriods'],
            $json['renewDomainPeriods'],
            $json['autoRenewDomainPeriods'],
            $json['transferFOA'],
            $json['adjustableAuthCode'],
            $json['customAuthcodeSupport'],
            $json['transferSupportsAuthcode'],
            $json['transferRequiresAuthcode'],
            $json['creationRequiresPreValidation'],
            $json['featuresAvailable'],
            $json['registrantChangeApprovalRequired'],
            $json['whoisExposure'],
            $json['gdprCategory'],
            DomainSyntax::fromArray($json['domainSyntax']),
            Nameservers::fromArray($json['nameservers']),
            Registrant::fromArray($json['registrant']),
            ContactsConstraint::fromArray($json['adminContacts']),
            ContactsConstraint::fromArray($json['billingContacts']),
            ContactsConstraint::fromArray($json['techContacts']),
            isset($json['contactProperties']) ? ContactPropertyCollection::fromArray($json['contactProperties']) : null,
            isset($json['launchPhases']) ? LaunchPhaseCollection::fromArray($json['launchPhases']) : null,
            $json['redemptionPeriod'] ?? null,
            $json['pendingDeletePeriod'] ?? null,
            $json['addGracePeriod'] ?? null,
            $json['renewGracePeriod'] ?? null,
            $json['autoRenewGracePeriod'] ?? null,
            $json['transferGracePeriod'] ?? null,
            $json['expiryDateOffset'] ?? null,
            $json['transferDomainPeriods'] ?? null,
            $json['possibleClientDomainStatuses'] ?? null,
            $json['allowedDnssecRecords'] ?? null,
            $json['allowedDnssecAlgorithms'] ?? null,
            $json['validationCategory'] ?? null,
            $json['zoneCheck'] ?? null,
            $json['allowDesignatedAgent'] ?? null,
            $json['jurisdiction'] ?? null,
            $json['termsOfService'] ?? null,
            $json['privacyPolicy'] ?? null,
            $json['premiumSupport']
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'createDomainPeriods' => $this->createDomainPeriods,
            'renewDomainPeriods' => $this->renewDomainPeriods,
            'autoRenewDomainPeriods' => $this->autoRenewDomainPeriods,
            'transferDomainPeriods' => $this->transferDomainPeriods,
            'redemptionPeriod' => $this->redemptionPeriod,
            'pendingDeletePeriod' => $this->pendingDeletePeriod,
            'addGracePeriod' => $this->addGracePeriod,
            'renewGracePeriod' => $this->renewGracePeriod,
            'autoRenewGracePeriod' => $this->autoRenewGracePeriod,
            'transferGracePeriod' => $this->transferGracePeriod,
            'expiryDateOffset' => $this->expiryDateOffset,
            'transferFOA' => $this->transferFOA,
            'adjustableAuthCode' => $this->adjustableAuthCode,
            'customAuthcodeSupport' => $this->customAuthcodeSupport,
            'transferSupportsAuthcode' => $this->transferSupportsAuthcode,
            'transferRequiresAuthcode' => $this->transferRequiresAuthcode,
            'creationRequiresPreValidation' => $this->creationRequiresPreValidation,
            'zoneCheck' => $this->zoneCheck,
            'possibleClientDomainStatuses' => $this->possibleClientDomainStatuses,
            'allowedDnssecRecords' => $this->allowedDnssecRecords,
            'allowedDnssecAlgorithms' => $this->allowedDnssecAlgorithms,
            'validationCategory' => $this->validationCategory,
            'featuresAvailable' => $this->featuresAvailable,
            'registrantChangeApprovalRequired' => $this->registrantChangeApprovalRequired,
            'allowDesignatedAgent' => $this->allowDesignatedAgent,
            'jurisdiction' => $this->jurisdiction,
            'termsOfService' => $this->termsOfService,
            'privacyPolicy' => $this->privacyPolicy,
            'whoisExposure' => $this->whoisExposure,
            'gdprCategory' => $this->gdprCategory,
            'premiumSupport' => $this->premiumSupport,
            'domainSyntax' => $this->domainSyntax->toArray(),
            'nameservers' => $this->nameservers->toArray(),
            'registrant' => $this->registrant->toArray(),
            'adminContacts' => $this->adminContacts->toArray(),
            'billingContacts' => $this->billingContacts->toArray(),
            'techContacts' => $this->techContacts->toArray(),
            'contactProperties' => $this->contactProperties ? $this->contactProperties->toArray() : null,
            'launchPhases' => $this->launchPhases ? $this->launchPhases->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
