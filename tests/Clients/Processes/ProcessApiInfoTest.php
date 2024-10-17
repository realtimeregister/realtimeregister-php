<?php

declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Processes;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\ProcessInfo;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessApiInfoTest extends TestCase
{
    public function test_get(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../../Domain/data/process_info_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/processes/46069000/info', $this)
        );

        $response = $sdk->processes->info(46069000);
        $this->assertInstanceOf(ProcessInfo::class, $response);
    }
}
