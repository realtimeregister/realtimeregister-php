<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Certificates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiDownloadCertificateTest extends TestCase
{
    public function test_download(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            'RAW_BASE64ENCODED_DATA'
        );

        $data = $sdk->certificates->downloadCertificate(1);

        self::assertSame($data, 'RAW_BASE64ENCODED_DATA');
    }
}
