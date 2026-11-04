<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Contacts;

use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/update', $this)
        );

        $sdk->contacts->update(
            'johndoe',
            'test',
            'John Doe',
            ['Theoreticalstreet 1'],
            '1234AB',
            'TheoreticalCity',
            'TheoreticalCountry',
            'test@example.com',
            '+31655555555',
            'Acme Corp',
            'Acme Corp',
            'TheoreticalState',
            '+31655555555'
        );
    }

    public function test_update_with_empty_fields(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/update', $this, expectedFields: [
                'customer' => 'johndoe',
                'handle' => 'test',
                'name' => 'John Doe',
                'organization' => '',
                'state' => '',
                'fax' => '',
            ])
        );

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            name: 'John Doe',
            organization: '',
            state: '',
            fax: '',
        );
    }

    public function test_update_with_verifications(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/update', $this, expectedFields: [
                'customer' => 'johndoe',
                'handle' => 'test',
                'verifications' => [
                    [
                        'verificationDate' => '2026-01-05T10:00:00+00:00',
                        'method' => 'EID_AUTH',
                        'proof' => 'ID_CARD',
                        'claims' => ['NAME', 'ADDRESS'],
                        'externalId' => 'ext-123',
                    ],
                    [
                        'verificationDate' => '2026-01-06T10:00:00Z',
                        'method' => 'REACHABILITY',
                        'proof' => 'LOG_RECORD',
                        'claims' => ['EMAIL'],
                        'externalId' => 'ext-456',
                    ],
                ],
            ])
        );

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            verifications: [
                [
                    'verificationDate' => new DateTimeImmutable('2026-01-05T10:00:00+00:00'),
                    'method' => 'EID_AUTH',
                    'proof' => 'ID_CARD',
                    'claims' => ['NAME', 'ADDRESS'],
                    'externalId' => 'ext-123',
                ],
                [
                    'verificationDate' => '2026-01-06T10:00:00Z',
                    'method' => 'REACHABILITY',
                    'proof' => 'LOG_RECORD',
                    'claims' => ['EMAIL'],
                    'externalId' => 'ext-456',
                ],
            ],
        );
    }

    public function test_update_with_incomplete_verification(): void
    {
        $sdk = MockedClientFactory::makeSdk(200, '');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Verification is missing required field: externalId');

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            verifications: [
                [
                    'verificationDate' => '2026-01-06T10:00:00Z',
                    'method' => 'REACHABILITY',
                    'proof' => 'LOG_RECORD',
                    'claims' => ['EMAIL'],
                ],
            ],
        );
    }

    public function test_update_with_validations(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/update', $this, expectedFields: [
                'customer' => 'johndoe',
                'handle' => 'test',
                'validations' => [
                    [
                        'category' => 'General',
                        'termsVersion' => '1',
                        'validatedBy' => '192.0.2.1',
                        'validatedOn' => '2026-01-05T10:00:00+00:00',
                    ],
                    [
                        'category' => 'IisSe',
                        'termsVersion' => '5',
                        'validatedBy' => '2001:db8::1',
                    ],
                ],
            ])
        );

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            validations: [
                [
                    'category' => 'General',
                    'termsVersion' => 1,
                    'validatedBy' => '192.0.2.1',
                    'validatedOn' => new DateTimeImmutable('2026-01-05T10:00:00+00:00'),
                ],
                [
                    'category' => 'IisSe',
                    'termsVersion' => '5',
                    'validatedBy' => '2001:db8::1',
                ],
            ],
        );
    }

    public function test_update_with_incomplete_validation(): void
    {
        $sdk = MockedClientFactory::makeSdk(200, '');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Validation is missing required field: validatedBy');

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            validations: [['category' => 'General', 'termsVersion' => '1']],
        );
    }

    public function test_update_with_invalid_validated_by(): void
    {
        $sdk = MockedClientFactory::makeSdk(200, '');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Validation validatedBy is not a valid IP address: not-an-ip');

        $sdk->contacts->update(
            customer: 'johndoe',
            handle: 'test',
            validations: [['category' => 'General', 'termsVersion' => '1', 'validatedBy' => 'not-an-ip']],
        );
    }
}
