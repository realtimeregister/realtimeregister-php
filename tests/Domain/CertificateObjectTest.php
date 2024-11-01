<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\AuthKey;
use RealtimeRegister\Domain\Certificate;
use RealtimeRegister\Domain\CertificateInfoProcess;
use RealtimeRegister\Exceptions\InvalidArgumentException;

/**
 * This TestCase is used to test all single Certificate Objects.
 * If you want to test Collections, use the CertificateCollectionTest instead.
 */
class CertificateObjectTest extends TestCase
{
    public static function parserDataSet(): array
    {
        /**
         * This data provider has three fields, the last one of which is optional.
         *  - Class: The data class that is tested.
         *  - Data: A data array, most commonly by including a php file.
         *  - Exception: (nullable), the exception to expect. If null: no exception should occur.
         */
        return [
            'valid certificate' => [
                Certificate::class,
                include __DIR__ . '/data/certificates/certificate_valid.php',
            ],
            'invalid certificate type' => [
                Certificate::class,
                include __DIR__ . '/data/certificates/certificate_type_invalid.php',
                InvalidArgumentException::class,
            ],
            'invalid validation_type' => [
                Certificate::class,
                include __DIR__ . '/data/certificates/certificate_validation_type_invalid.php',
                InvalidArgumentException::class,
            ],
            'invalid status' => [
                Certificate::class,
                include __DIR__ . '/data/certificates/certificate_status_invalid.php',
                InvalidArgumentException::class,
            ],
            'invalid public key algorithm' => [
                Certificate::class,
                include __DIR__ . '/data/certificates/certificate_public_key_algorithm_invalid.php',
                InvalidArgumentException::class,
            ],
            'valid generate certificate request' => [
                AuthKey::class,
                include __DIR__ . '/data/certificates/certificate_generate_auth_request_valid.php',
            ],
            'info process request' => [
                CertificateInfoProcess::class,
                include __DIR__ . '/data/certificates/certificate_info_process_dns.php',
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            self::expectException($exception);
        }
        // Object from array
        $object = call_user_func($class . '::fromArray', $data);
        self::assertSame($class, get_class($object), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Object to array
        $array = $object->toArray();
        self::assertSame($data, $array, "{$class}::toArray() gave an unexpected result.");
    }
}
