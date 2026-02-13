<?php declare(strict_types = 1);

namespace RealtimeRegister;

use Psr\Log\LoggerInterface;
use RealtimeRegister\Api\AcmeApi;
use RealtimeRegister\Api\BrandsApi;
use RealtimeRegister\Api\CertificatesApi;
use RealtimeRegister\Api\ContactsApi;
use RealtimeRegister\Api\CustomersApi;
use RealtimeRegister\Api\DnsTemplatesApi;
use RealtimeRegister\Api\DnsZonesApi;
use RealtimeRegister\Api\DomainsApi;
use RealtimeRegister\Api\FinancialApi;
use RealtimeRegister\Api\HostsApi;
use RealtimeRegister\Api\NotificationsApi;
use RealtimeRegister\Api\ProcessesApi;
use RealtimeRegister\Api\ProvidersApi;
use RealtimeRegister\Api\TLDsApi;
use RealtimeRegister\Support\AuthorizedClient;

final class RealtimeRegister
{
    private const BASE_URL = 'https://api.yoursrs.com/';

    public AcmeApi $acme;

    public BrandsApi $brands;

    public CertificatesApi $certificates;

    public ContactsApi $contacts;

    public CustomersApi $customers;

    public DomainsApi $domains;

    public HostsApi $hosts;

    public NotificationsApi $notifications;

    public ProcessesApi $processes;

    public ProvidersApi $providers;

    public DnsTemplatesApi $dnstemplates;

    public DnsZonesApi $dnszones;

    public TLDsApi $tlds;

    public FinancialApi $financial;

    public function __construct(
        string $apiKey,
        ?string $baseUrl = null,
        ?LoggerInterface $logger = null
    ) {
        $url = $baseUrl ?: self::BASE_URL;
        $this->setClient(new AuthorizedClient($url, $apiKey, [], $logger));
    }

    public function setClient(AuthorizedClient $client): void
    {
        $this->acme = new AcmeApi($client);
        $this->brands = new BrandsApi($client);
        $this->certificates = new CertificatesApi($client);
        $this->contacts = new ContactsApi($client);
        $this->customers = new CustomersApi($client);
        $this->domains = new DomainsApi($client);
        $this->hosts = new HostsApi($client);
        $this->notifications = new NotificationsApi($client);
        $this->processes = new ProcessesApi($client);
        $this->providers = new ProvidersApi($client);
        $this->dnstemplates = new DnsTemplatesApi($client);
        $this->dnszones = new DnsZonesApi($client);
        $this->tlds = new TLDsApi($client);
        $this->financial = new FinancialApi($client);
    }
}
