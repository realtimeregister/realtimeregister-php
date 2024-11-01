<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Dns\Zones;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiAckUpdateTest extends TestCase
{
    public function test_ack_ds_update(): void
    {
        $processId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', "v2/processes/{$processId}/ack-ds-update", $this)
        );

        $sdk->dnszones->ackDSUpdate($processId);
    }
}
