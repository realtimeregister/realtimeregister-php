<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Contacts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', 'v2/customers/johndoe/contacts/test', $this)
        );

        $sdk->contacts->delete('johndoe', 'test');
    }
}
