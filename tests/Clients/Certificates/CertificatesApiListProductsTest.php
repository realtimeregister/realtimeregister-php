<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Certificates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\Product;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiListProductsTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../../Domain/data/certificates/ssl_product_valid.php',
                ],
                'pagination' => [
                    'total' => 1,
                    'offset' => 0,
                    'limit' => 5,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', '/v2/ssl/products', $this, [
                'limit' => '5',
                'offset' => '0',
                'q' => 'ssl',
            ])
        );

        $products = $sdk->certificates->listProducts(5, 0, 'ssl');

        self::assertCount(1, $products);
        self::assertInstanceOf(Product::class, $products[0]);
    }
}
