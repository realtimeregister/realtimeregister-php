<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Validation;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\ValidationCategoryCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ValidationApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/validation/categories', $this)
        );

        $response = $sdk->validation->list();

        $this->assertInstanceOf(ValidationCategoryCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/validation/categories', $this)
        );

        $response = $sdk->validation->list(3, 0, 'category');

        $this->assertInstanceOf(ValidationCategoryCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'name:like' => 'General',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                    include __DIR__ . '/../../Domain/data/validation/category_valid.php',
                ],
                'pagination' => [
                    'total'  => 2,
                    'offset' => 0,
                    'limit'  => 2,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/validation/categories', $this, [
                'name:like' => 'General',
                'limit' => '2',
                'offset' => '0',
                'q' => 'category',
            ])
        );

        $response = $sdk->validation->list(2, 0, 'category', $parameters);

        $this->assertInstanceOf(ValidationCategoryCollection::class, $response);
    }
}
