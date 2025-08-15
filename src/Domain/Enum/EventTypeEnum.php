<?php

declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

enum EventTypeEnum: string
{
    case RequestCertificateEvent = 'RequestCertificateEvent';
    case CreateDomainEvent = 'CreateDomainEvent';
    case DeleteDomainEvent = 'DeleteDomainEvent';
    case RenewDomainEvent = 'RenewDomainEvent';
    case UpdateDomainEvent = 'UpdateDomainEvent';
    case TransferDomainEvent = 'TransferDomainEvent';
    case SSLCertificateExpiryReportEvent = 'SSLCertificateExpiryReportEvent';
    case TestEvent = 'TestEvent';
}
