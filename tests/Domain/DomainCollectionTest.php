<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\AccountCollection;
use RealtimeRegister\Domain\BillableCollection;
use RealtimeRegister\Domain\BrandCollection;
use RealtimeRegister\Domain\ContactCollection;
use RealtimeRegister\Domain\ContactPropertyCollection;
use RealtimeRegister\Domain\CountryCollection;
use RealtimeRegister\Domain\DomainAvailabilityCollection;
use RealtimeRegister\Domain\DomainContactCollection;
use RealtimeRegister\Domain\DomainDetailsCollection;
use RealtimeRegister\Domain\DomainObjectInterface;
use RealtimeRegister\Domain\DowntimeCollection;
use RealtimeRegister\Domain\DsDataCollection;
use RealtimeRegister\Domain\KeyDataCollection;
use RealtimeRegister\Domain\LaunchPhaseCollection;
use RealtimeRegister\Domain\LogCollection;
use RealtimeRegister\Domain\NotificationCollection;
use RealtimeRegister\Domain\PriceCollection;
use RealtimeRegister\Domain\ProcessCollection;
use RealtimeRegister\Domain\ProviderCollection;
use RealtimeRegister\Domain\TemplateCollection;

/**
 * This TestCase is used to test all Domain Object Collections.
 * If you want to test Domain Objects, use the DomainObjectTest instead.
 */
class DomainCollectionTest extends TestCase
{
    public static function parserDataSet(): array
    {
        /**
         * A flat and a pagination is generated for each scenario.
         * The arguments:
         *  - Class
         *  - Entity data.
         */
        $scenarios = [
            'account collection' => [AccountCollection::class, include __DIR__ . '/data/customers/account_valid.php'],
            'billable collection' => [BillableCollection::class, include __DIR__ . '/data/financial/billable_valid.php'],
            'country collection' => [CountryCollection::class, include __DIR__ . '/data/country_valid.php'],
            'contact collection' => [ContactCollection::class, include __DIR__ . '/data/contacts/contact_valid.php'],
            'domain availability collection' => [DomainAvailabilityCollection::class, include __DIR__ . '/data/domains/domain_availability_valid.php'],
            'domain contact collection' => [DomainContactCollection::class, include __DIR__ . '/data/domains/domain_contact_valid.php'],
            'domain details collection' => [DomainDetailsCollection::class, include __DIR__ . '/data/domains/domain_details_valid.php'],
            'ds data collection' => [DsDataCollection::class, include __DIR__ . '/data/ds_data_valid.php'],
            'key data collection' => [KeyDataCollection::class, include __DIR__ . '/data/key_data_valid.php'],
            'price collection' => [PriceCollection::class, include __DIR__ . '/data/price_valid.php'],
            'contact property collection' => [ContactPropertyCollection::class, include __DIR__ . '/data/contacts/contact_property_valid.php'],
            'launch phase collection' => [LaunchPhaseCollection::class, include __DIR__ . '/data/launch_phase.php'],
            'log collection' => [LogCollection::class, include __DIR__ . '/data/log.php'],
            'notification collection' => [NotificationCollection::class, include __DIR__ . '/data/notifications/notification_valid.php'],
            'process collection' => [ProcessCollection::class, include __DIR__ . '/data/processes/process_valid_only_required.php'],
            'provider collection' => [ProviderCollection::class, include __DIR__ . '/data/provider_valid.php'],
            'downtime collection' => [DowntimeCollection::class, include __DIR__ . '/data/downtime_valid.php'],
            'brand collection' => [BrandCollection::class, include __DIR__ . '/data/brands/brand_valid.php'],
            'template collection' => [TemplateCollection::class, include __DIR__ . '/data/template_valid.php'],
        ];
        // For each type, create a flat and a pagination scenario.
        $dataset = [];
        foreach ($scenarios as $key => $scenario) {
            $dataset["{$key} (flat)"] = [
                $scenario[0],
                [$scenario[1], $scenario[1], $scenario[1]],
                3,
            ];
            $dataset["{$key} (pagination)"] = [
                $scenario[0],
                [
                    'entities' => [$scenario[1], $scenario[1], $scenario[1]],
                    'pagination' => [
                        'total'  => 3,
                        'offset' => 0,
                        'limit'  => 3,
                    ],
                ],
                3,
            ];
        }
        return $dataset;
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, int $count, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            self::expectException($exception);
        }
        // Object from array
        $collection = call_user_func($class . '::fromArray', $data);
        self::assertSame($class, get_class($collection), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Array access.
        self::assertInstanceOf(DomainObjectInterface::class, $collection[0], 'Instance in collection does not implement DomainObjectInterface');
        self::assertTrue(isset($collection[0]), 'Cannot access property in array');
        self::assertFalse(isset($collection[3]), 'Unexpectedly, key 3 was set on collection');
        self::assertFalse(isset($collection[4]), 'Unexpectedly, key 4 was set on collection');
        $collection[3] = $collection[0];
        $collection[] = $collection[0];
        self::assertTrue(isset($collection[3]), 'Failed to set item on collection');
        self::assertTrue(isset($collection[4]), 'Failed to push item to collection');
        self::assertSame(5, count($collection));
        foreach ($collection as $item) {
            self::assertInstanceOf(DomainObjectInterface::class, $item, 'Instance in collection does not implement DomainObjectInterface');
        }
        unset($collection[4]);
        self::assertSame(4, count($collection), 'Failed to unset item in collection');

        // Pagination values.
        self::assertSame($count, $collection->pagination->total, 'Pagination total gave an unexpected value.');
        self::assertSame(3, $collection->pagination->limit, 'Pagination limit gave an unexpected value.');
        self::assertSame(0, $collection->pagination->offset, 'Pagination offset gave an unexpected value.');

        // To array.
        $array = $collection->toArray();
        self::assertIsArray($array, "{$class}::toArray() gave an unexpected result");
        $item = $array[0];
        self::assertIsArray($item, 'Child of collection was not transformed to array');
    }
}
