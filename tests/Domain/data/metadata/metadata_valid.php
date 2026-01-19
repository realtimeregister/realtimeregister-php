<?php declare(strict_types=1);

return [
    'createDomainPeriods' => [12],
    'renewDomainPeriods' => [12],
    'autoRenewDomainPeriods' => [12],
    'transferDomainPeriods' => [12, 24],
    'redemptionPeriod' => 30,
    'pendingDeletePeriod' => 5,
    'addGracePeriod' => 5,
    'renewGracePeriod' => 5,
    'autoRenewGracePeriod' => 42,
    'transferGracePeriod' => 5,
    'expiryDateOffset' => 3600,
    'transferFOA' => false,
    'adjustableAuthCode' => false,
    'customAuthcodeSupport' => false,
    'transferSupportsAuthcode' => false,
    'transferRequiresAuthcode' => false,
    'creationRequiresPreValidation' => false,
    'featuresAvailable' => ['CREATE', 'RENEW'],
    'registrantChangeApprovalRequired' => false,
    'whoisExposure' => 'FULL',
    'gdprCategory' => 'EU_BASED',
    'premiumSupport' => 'REGULAR',
    'domainSyntax' => ['minLength' => 1, 'maxLength' => 64, 'idnSupport' => false], // DomainSyntax
    'nameservers' => ['min' => 0, 'max' => 13, 'required' => false], // Nameservers
    'registrant' => [ 'organizationRequired' => false, 'organizationAllowed' => true], // Registrant
    'adminContacts' => ['min' => 0, 'max' => 10, 'required' => false, 'organizationRequired' => false, 'organizationAllowed' => true],  // ContactsConstraint
    'billingContacts' => ['min' => 0, 'max' => 10, 'required' => false, 'organizationRequired' => false, 'organizationAllowed' => true], // ContactsConstraint
    'techContacts' => ['min' => 0, 'max' => 10, 'required' => false, 'organizationRequired' => false, 'organizationAllowed' => true], // ContactsConstraint
];

