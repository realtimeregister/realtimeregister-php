<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

enum NotificationTypeEnum: string
{
    case SSLCertificateNotification = 'SSLCertificateNotification';
    case CreateDomainNotification = 'CreateDomainNotification';
    case DeleteDomainNotification = 'DeleteDomainNotification';
    case RenewDomainNotification = 'RenewDomainNotification';
    case UpdateDomainNotification = 'UpdateDomainNotification';
    case TransferDomainNotification = 'TransferDomainNotification';
    case DomainNotification = 'DomainNotification';
    case SSLCertificateExpiryReportNotification = 'SSLCertificateExpiryReportNotification';
    case TestNotification = 'TestNotification';
}
