<?php declare(strict_types = 1);

return [
    'provider' => 'SIDN',
    'applicableFor' => ['nl'],
    'metadata' => [
        'createDomainPeriods' => [12],
        'renewDomainPeriods' => [12],
        'autoRenewDomainPeriods' => [12],
        'transferDomainPeriods' => [12],
        'redemptionPeriod' => 1,
        'pendingDeletePeriod' => 1,
        'addGracePeriod' => 1,
        'renewGracePeriod' => 1,
        'autoRenewGracePeriod' => 1,
        'transferGracePeriod' => 1,
        'expiryDateOffset' => 1,
        'transferFOA' => true,
        'adjustableAuthCode' => true,
        'customAuthcodeSupport' => true,
        'transferSupportsAuthcode' => true,
        'transferRequiresAuthcode' => true,
        'creationRequiresPreValidation' => true,
        'zoneCheck' => 'True',
        'possibleClientDomainStatuses' => [
            'CLIENT_HOLD',
            'CLIENT_DELETE_PROHIBITED',
            'CLIENT_UPDATE_PROHIBITED',
            'CLIENT_RENEW_PROHIBITED',
            'CLIENT_TRANSFER_PROHIBITED',
            'IRTPC_TRANSFER_PROHIBITED',
        ],
        'allowedDnssecRecords' => 3,
        'allowedDnssecAlgorithms' => [3, 5, 6, 7, 8, 10, 12, 13, 14, 15, 16],
        'validationCategory' => 'General',
        'featuresAvailable' => [
            'CREATE',
            'RENEW',
            'TRANSFER',
            'RESTORE',
            'UPDATE',
            'PRIVACY_PROTECT',
            'PUSH_TRANSFER',
        ],
        'registrantChangeApprovalRequired' => true,
        'allowDesignatedAgent' => 'OLD',
        'jurisdiction' => 'the Netherlands',
        'termsOfService' => 'blabla',
        'privacyPolicy' => 'blablabla',
        'whoisExposure' => 'NONE',
        'gdprCategory' => 'EU_BASED',
        'premiumSupport' => 'REGULAR',
        'domainSyntax' => include __DIR__ . '/domains/domain_syntax.php',
        'nameservers' => include __DIR__ . '/nameservers.php',
        'registrant' => include __DIR__ . '/registrant.php',
        'adminContacts' => include __DIR__ . '/contacts/contacts_constraint.php',
        'billingContacts' => include __DIR__ . '/contacts/contacts_constraint.php',
        'techContacts' => include __DIR__ . '/contacts/contacts_constraint.php',
        'contactProperties' => [include __DIR__ . '/contacts/contact_property_valid.php'],
        'launchPhases' => [include __DIR__ . '/launch_phase.php'],
    ],
];
