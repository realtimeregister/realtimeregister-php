<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Contacts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Contact;
use RealtimeRegister\Domain\ContactRegistryAccountCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/contacts/contact_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/contacts/test', $this)
        );

        $response = $sdk->contacts->get('johndoe', 'test');
        $this->assertInstanceOf(Contact::class, $response);

        $this->assertInstanceOf(ContactRegistryAccountCollection::class, $response->registryAccounts);
    }
}
