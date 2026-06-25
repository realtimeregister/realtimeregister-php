<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Validation;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\ValidationCategory;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ValidationApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/validation/category_valid_with_valid_until.php'),
            MockedClientFactory::assertRoute('GET', 'v2/validation/categories/IisNu', $this)
        );

        $response = $sdk->validation->get('IisNu');

        $this->assertInstanceOf(ValidationCategory::class, $response);
    }
}
