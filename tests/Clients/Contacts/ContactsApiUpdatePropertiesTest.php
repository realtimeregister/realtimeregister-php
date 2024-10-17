<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Contacts;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiUpdatePropertiesTest extends TestCase
{
    public function test_update_properties(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/sidn/update', $this)
        );

        $sdk->contacts->updateProperties('johndoe', 'test', 'sidn', [
            'is_verified' => 'true',
        ]);
    }
}
