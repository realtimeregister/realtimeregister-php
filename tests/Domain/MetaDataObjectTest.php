<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\TLDMetaData;
use RealtimeRegister\Exceptions\InvalidArgumentException;

/**
 * This TestCase is used to test all single Domain Objects.
 * If you want to test Collections, use the DomainCollectionTest instead.
 */
class MetaDataObjectTest extends TestCase
{
    public static function parserDataSet(): array
    {
        return [
            'valid metadata' => [
                TLDMetaData::class,
                include __DIR__ . '/data/metadata/metadata_valid.php',
            ],
            'metadata_unknown_feature' => [
                TLDMetaData::class,
                include __DIR__ . '/data/metadata/metadata_unknown_feature.php',
            ],
            'metadata_unknown_feature_exception' => [
                TLDMetaData::class,
                include __DIR__ . '/data/metadata/metadata_unknown_feature.php',
                InvalidArgumentException::class
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, ?string $exception = null): void
    {
        try {
            set_error_handler(function ($errno, $errstr) use ($exception) {
                if ($errno === E_USER_WARNING && $exception) {
                    throw new InvalidArgumentException($errstr);
                }
            });
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
        } finally {
            restore_error_handler();
        }
    }
}
