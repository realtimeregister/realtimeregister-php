<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Certificates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiAddNoteTest extends TestCase
{
    public function test_add(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/processes/1/add-note', $this)
        );

        $sdk->certificates->addNote(1, 'message');
    }
}
