<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Api\ContactsApi;
use RealtimeRegister\Api\CustomersApi;
use RealtimeRegister\Api\DomainsApi;
use RealtimeRegister\Api\NotificationsApi;
use RealtimeRegister\Api\ProcessesApi;
use RealtimeRegister\Api\ProvidersApi;
use RealtimeRegister\RealtimeRegister;
use RealtimeRegister\Support\AuthorizedClient;

/** @covers \RealtimeRegister\RealtimeRegister */
class RealtimeRegisterClientTest extends TestCase
{
    public function test_construct(): void
    {
        $client = new RealtimeRegister('https://example.com/api/v2/', 'bigsecretdonttellanyone');

        $client->setClient(new AuthorizedClient('https://example.com/api/v2/', 'bigsecretdonttellanyone'));

        $this->assertInstanceOf(RealtimeRegister::class, $client, 'The $client could not be instantiated.');
        $this->assertInstanceOf(ContactsApi::class, $client->contacts, 'The contacts could not be instantiated.');
        $this->assertInstanceOf(CustomersApi::class, $client->customers, 'The customers could not be instantiated.');
        $this->assertInstanceOf(DomainsApi::class, $client->domains, 'The domains could not be instantiated.');
        $this->assertInstanceOf(NotificationsApi::class, $client->notifications, 'The notifications could not be instantiated.');
        $this->assertInstanceOf(ProvidersApi::class, $client->providers, 'The providers could not be instantiated.');
        $this->assertInstanceOf(ProcessesApi::class, $client->processes, 'The processes could not be instantiated.');
    }
}
