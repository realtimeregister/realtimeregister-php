<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Brands;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class BrandsApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $customerHandle = 'customertestname';
        $brandHandle = 'brandtestname';

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', "v2/customers/{$customerHandle}/brands/{$brandHandle}", $this)
        );

        $sdk->brands->delete($customerHandle, $brandHandle);
    }
}
