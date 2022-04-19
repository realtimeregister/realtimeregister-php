<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiReissueCertificateTest extends TestCase
{
    public function test_reissue(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            202,
            '',
            MockedClientFactory::assertRoute('POST', '/v2/ssl/certificates/1/reissue', $this)
        );

        $sdk->certificates->reissueCertificate(
            1,
            '-----BEGIN CERTIFICATE REQUEST-----\nMIIC6zCCAdMCAQAwgaUxCzAJBgNVBAYTAk5MMRMwEQYDVQQIDApHZWxkZXJsYW5k\nMREwDwYDVQQHDAhTaW5kZXJlbjERMA8GA1UECgwIU2FuZHdhdmUxETAPBgNVBAsM\nCEludGVybmV0MSMwIQYDVQQDDBp3d3cudGVzdGluZ2Fzc2xyZXF1ZXN0LmNvbTEj\nMCEGCSqGSIb3DQEJARYUYXJuby5ib3RAc2FuZHdhdmUuaW8wggEiMA0GCSqGSIb3\nDQEBAQUAA4IBDwAwggEKAoIBAQDGW2yZOov0ug7d3zrnHyJtdegguLcdVSc9sbhg\nqKzwNSyQeVfvLgSqFu8glT28FAPJy1fhNydJm8WUvV29+UdiUIx7a0nWNNsBNRQ2\nglk8g+cklwemyuTPvlhvQC1RtQtoer4ibgd4TjP3/cZLHpakTRZYbz6XIsYOA7si\nlBzMfsxNwuAtB+NvJd9Guscu8yGS3cXG/K9xkQrT/uuTjLoynTjXmZXzHpEDz39/\n60F5aKbkl/OzgUYrct5on/aLUhcv1heoYah6XsxIjrtPpTFMxAA0JR3SGHnCe1rP\nyoPP5k9chQ6q+ljw9/Wgs1iVyl8DJFYWTlI0ztPaEUX+FoDFAgMBAAGgADANBgkq\nhkiG9w0BAQsFAAOCAQEAw8cD4C0yHF+vXBgTkCsclbSVj7chx37Al9qUp7r5dOdS\nsxWPFHZVyfaxWIfh/C1ydAd7gpoW2eyc51qwV0pp2Y20V+cR4PjunO+HErWCSm67\n5HVeqsGYYIW/vL0MbfrYJCSVIVB89UEDTtcZ4vdVAG0D2cwfkBV4qNlg++LATpXn\nILtgC157yLc6E8DVUEgjLEjt/xAsANQb4f0yLVSoeGHPIejRmvVQjTkz5Xk5e6vt\nsKYP2GbIIvy5xXwDKhdGVi5XpNgO5PupJyScU4C9ssLCjcF6l60y8jkZypesUwWH\n9Fh3UbrYKTu5+V99QSNz8sZXIxk2hMnqjDdttpNgtg==\n-----END CERTIFICATE REQUEST-----',
            [],
            'Example',
            'Example department',
            'ExampleStr. 1',
            '1234AB',
            'Amsterdam',
            '12345678',
            null,
            [
                'commonName' => 'www.example.com',
                'type' => DcvTypeEnum::LOCALE_DNS,
            ]
        );
    }
}