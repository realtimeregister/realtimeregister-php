<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiTransferTest extends TestCase
{
    public function test_transfer(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/transfer', $this)
        );

        $sdk->domains->transfer(
            'example.com',
            'test',
            'John Doe',
            false,
            12,
            '123123123',
            true,
            [],
            'test',
            'OLD',
            Zone::fromArray(include __DIR__ . '/../Domain/data/zone_valid.php'),
            ContactCollection::fromArray([include __DIR__ . '/../Domain/data/contact_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../Domain/data/billable_valid.php'])
        );
    }
}
