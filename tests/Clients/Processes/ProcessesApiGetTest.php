<?php
declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Processes;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Process;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessesApiGetTest extends TestCase
{
    public function test_get(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../../Domain/data/processes/process_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/processes/46069000', $this)
        );

        $response = $sdk->processes->get(46069000);
        $this->assertInstanceOf(Process::class, $response);
    }
}
