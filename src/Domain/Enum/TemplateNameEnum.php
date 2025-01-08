<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class TemplateNameEnum extends AbstractEnum
{
    const TEMPLATE_NAME_EMAIL_HEADER = 'EMAIL_HEADER';
    const TEMPLATE_NAME_EMAIL_FOOTER = 'EMAIL_FOOTER';
    const TEMPLATE_NAME_ERRP_WEEK = 'ERRP_WEEK';
    const TEMPLATE_NAME_ERRP_MONTH = 'ERRP_MONTH';
    const TEMPLATE_NAME_ERRP_EXPIRED = 'ERRP_EXPIRED';
    const TEMPLATE_NAME_WEB_HEADER = 'WEB_HEADER';
    const TEMPLATE_NAME_WEB_FOOTER = 'WEB_FOOTER';
    const TEMPLATE_NAME_INCOMING_FOA_FORM = 'INCOMING_FOA_FORM';
    const TEMPLATE_NAME_INCOMING_FOA = 'INCOMING_FOA';
    const TEMPLATE_NAME_INTERNAL_FOA_FORM = 'INTERNAL_FOA_FORM';
    const TEMPLATE_NAME_INTERNAL_FOA = 'INTERNAL_FOA';
    const TEMPLATE_NAME_INCOMING_TOKEN_FORM = 'INCOMING_TOKEN_FORM';
    const TEMPLATE_NAME_INTERNAL_TOKEN_FORM = 'INTERNAL_TOKEN_FORM';
    const TEMPLATE_NAME_OUTGOING_FOA_FORM = 'OUTGOING_FOA_FORM';
    const TEMPLATE_NAME_OUTGOING_FOA = 'OUTGOING_FOA';
    const TEMPLATE_NAME_THANK_YOU_PAGE = 'THANK_YOU_PAGE';
    const TEMPLATE_NAME_ERROR_PAGE = 'ERROR_PAGE';
    const TEMPLATE_NAME_PENDING_VALIDATION = 'PENDING_VALIDATION';
    const TEMPLATE_NAME_VALIDATE_CONTACT_FORM = 'VALIDATE_CONTACT_FORM';
    const TEMPLATE_NAME_VALIDATE_CONTACT = 'VALIDATE_CONTACT';
    const TEMPLATE_NAME_WHOIS = 'WHOIS';
    const TEMPLATE_NAME_WDRP = 'WDRP';
    const TEMPLATE_NAME_CONFIRM_BRAND = 'CONFIRM_BRAND';
    const TEMPLATE_NAME_CONFIRM_BRAND_FORM = 'CONFIRM_BRAND_FORM';
    const TEMPLATE_NAME_UPDATE_DOMAIN_TOKEN_FORM = 'UPDATE_DOMAIN_TOKEN_FORM';
    const TEMPLATE_NAME_TMCH_CLAIM_ACK = 'TMCH_CLAIM_ACK';
    const TEMPLATE_NAME_TMCH_CLAIM_ACK_AND_VALIDATION = 'TMCH_CLAIM_ACK_AND_VALIDATION';
    const TEMPLATE_NAME_TMCH_CLAIM_ACK_FORM = 'TMCH_CLAIM_ACK_FORM';
    const TEMPLATE_NAME_TMCH_CLAIM_ACK_AND_VALIDATION_FORM = 'TMCH_CLAIM_ACK_AND_VALIDATION_FORM';
    const TEMPLATE_NAME_EXPIRED_PAGE = 'EXPIRED_PAGE';
    const TEMPLATE_NAME_UPDATE_DOMAIN_OLD_REGISTRANT = 'UPDATE_DOMAIN_OLD_REGISTRANT';
    const TEMPLATE_NAME_UPDATE_DOMAIN_OLD_REGISTRANT_FORM = 'UPDATE_DOMAIN_OLD_REGISTRANT_FORM';
    const TEMPLATE_NAME_UPDATE_DOMAIN_NEW_REGISTRANT = 'UPDATE_DOMAIN_NEW_REGISTRANT';
    const TEMPLATE_NAME_UPDATE_DOMAIN_NEW_REGISTRANT_FORM = 'UPDATE_DOMAIN_NEW_REGISTRANT_FORM';
    const TEMPLATE_NAME_UPDATE_CONTACT_OLD_REGISTRANT = 'UPDATE_CONTACT_OLD_REGISTRANT';
    const TEMPLATE_NAME_UPDATE_CONTACT_OLD_REGISTRANT_FORM = 'UPDATE_CONTACT_OLD_REGISTRANT_FORM';
    const TEMPLATE_NAME_UPDATE_CONTACT_NEW_REGISTRANT = 'UPDATE_CONTACT_NEW_REGISTRANT';
    const TEMPLATE_NAME_UPDATE_CONTACT_NEW_REGISTRANT_FORM = 'UPDATE_CONTACT_NEW_REGISTRANT_FORM';
    const TEMPLATE_NAME_INTERNAL_TRANSFER_NEW_REGISTRANT = 'INTERNAL_TRANSFER_NEW_REGISTRANT';
    const TEMPLATE_NAME_INTERNAL_TRANSFER_NEW_REGISTRANT_FORM = 'INTERNAL_TRANSFER_NEW_REGISTRANT_FORM';
    const TEMPLATE_NAME_INCOMING_TRANSFER_NEW_REGISTRANT = 'INCOMING_TRANSFER_NEW_REGISTRANT';
    const TEMPLATE_NAME_INCOMING_TRANSFER_NEW_REGISTRANT_FORM = 'INCOMING_TRANSFER_NEW_REGISTRANT_FORM';
    const TEMPLATE_NAME_OLD_REGISTRANT_CHANGE_NOTIFICATION = 'OLD_REGISTRANT_CHANGE_NOTIFICATION';
    const TEMPLATE_NAME_NEW_REGISTRANT_CHANGE_NOTIFICATION = 'NEW_REGISTRANT_CHANGE_NOTIFICATION';
    const TEMPLATE_NAME_UPDATE_DOMAIN = 'UPDATE_DOMAIN';
    const TEMPLATE_NAME_OUTGOING_TRANSFER_PRIVACY_PROTECT = 'OUTGOING_TRANSFER_PRIVACY_PROTECT';

    protected static array $values = [
        TemplateNameEnum::TEMPLATE_NAME_EMAIL_HEADER,
        TemplateNameEnum::TEMPLATE_NAME_EMAIL_FOOTER,
        TemplateNameEnum::TEMPLATE_NAME_ERRP_WEEK,
        TemplateNameEnum::TEMPLATE_NAME_ERRP_MONTH,
        TemplateNameEnum::TEMPLATE_NAME_ERRP_EXPIRED,
        TemplateNameEnum::TEMPLATE_NAME_WEB_HEADER,
        TemplateNameEnum::TEMPLATE_NAME_WEB_FOOTER,
        TemplateNameEnum::TEMPLATE_NAME_INCOMING_FOA_FORM,
        TemplateNameEnum::TEMPLATE_NAME_INCOMING_FOA,
        TemplateNameEnum::TEMPLATE_NAME_INTERNAL_FOA_FORM,
        TemplateNameEnum::TEMPLATE_NAME_INTERNAL_FOA,
        TemplateNameEnum::TEMPLATE_NAME_INCOMING_TOKEN_FORM,
        TemplateNameEnum::TEMPLATE_NAME_INTERNAL_TOKEN_FORM,
        TemplateNameEnum::TEMPLATE_NAME_OUTGOING_FOA_FORM,
        TemplateNameEnum::TEMPLATE_NAME_OUTGOING_FOA,
        TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE,
        TemplateNameEnum::TEMPLATE_NAME_ERROR_PAGE,
        TemplateNameEnum::TEMPLATE_NAME_PENDING_VALIDATION,
        TemplateNameEnum::TEMPLATE_NAME_VALIDATE_CONTACT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_VALIDATE_CONTACT,
        TemplateNameEnum::TEMPLATE_NAME_WHOIS,
        TemplateNameEnum::TEMPLATE_NAME_WDRP,
        TemplateNameEnum::TEMPLATE_NAME_CONFIRM_BRAND,
        TemplateNameEnum::TEMPLATE_NAME_CONFIRM_BRAND_FORM,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN_TOKEN_FORM,
        TemplateNameEnum::TEMPLATE_NAME_TMCH_CLAIM_ACK,
        TemplateNameEnum::TEMPLATE_NAME_TMCH_CLAIM_ACK_AND_VALIDATION,
        TemplateNameEnum::TEMPLATE_NAME_TMCH_CLAIM_ACK_FORM,
        TemplateNameEnum::TEMPLATE_NAME_TMCH_CLAIM_ACK_AND_VALIDATION_FORM,
        TemplateNameEnum::TEMPLATE_NAME_EXPIRED_PAGE,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN_OLD_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN_OLD_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN_NEW_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN_NEW_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_CONTACT_OLD_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_CONTACT_OLD_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_CONTACT_NEW_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_CONTACT_NEW_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_INTERNAL_TRANSFER_NEW_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_INTERNAL_TRANSFER_NEW_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_INCOMING_TRANSFER_NEW_REGISTRANT,
        TemplateNameEnum::TEMPLATE_NAME_INCOMING_TRANSFER_NEW_REGISTRANT_FORM,
        TemplateNameEnum::TEMPLATE_NAME_OLD_REGISTRANT_CHANGE_NOTIFICATION,
        TemplateNameEnum::TEMPLATE_NAME_NEW_REGISTRANT_CHANGE_NOTIFICATION,
        TemplateNameEnum::TEMPLATE_NAME_UPDATE_DOMAIN,
        TemplateNameEnum::TEMPLATE_NAME_OUTGOING_TRANSFER_PRIVACY_PROTECT,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        TemplateNameEnum::assertValueValid($value);
    }
}
