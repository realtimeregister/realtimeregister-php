<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Processes;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessesApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../../Domain/data/processes/process_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('DELETE', 'v2/processes/123', $this)
        );

        $sdk->processes->delete(123);
    }
}
