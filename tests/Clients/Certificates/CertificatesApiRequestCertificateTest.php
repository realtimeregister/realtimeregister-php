<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Certificates;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\CertificateInfoProcess;
use RealtimeRegister\Domain\Enum\DcvStatusEnum;
use RealtimeRegister\Domain\Enum\DcvTypeEnum;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiRequestCertificateTest extends TestCase
{
    public function test_request(): void
    {
        $sdk = MockedClientFactory::makeMockedSdk(
            static function (): Response {
                return new Response(
                    202,
                    [
                        'x-process-id' => 20,
                    ],
                    json_encode([
                        'commonName' => 'commonname.com',
                        'requiresAttention' => true,
                        'validations' => [
                            'dcv' =>
                                [
                                    [
                                        'commonName' => 'example.com',
                                        'type' => DcvTypeEnum::LOCALE_EMAIL,
                                        'email' => 'admin@example.com',
                                        'status' => DcvStatusEnum::DCV_STATUS_ATTENTION,
                                    ],
                                ],
                        ],
                    ], JSON_THROW_ON_ERROR),
                );
            },
            MockedClientFactory::assertRoute('POST', 'v2/ssl/certificates', $this)
        );

        $processResult = $sdk->certificates->requestCertificate(
            'customer',
            'ssl',
            6,
            '-----BEGIN CERTIFICATE REQUEST-----\nMIIC6zCCAdMCAQAwgaUxCzAJBgNVBAYTAk5MMRMwEQYDVQQIDApHZWxkZXJsYW5k\nMREwDwYDVQQHDAhTaW5kZXJlbjERMA8GA1UECgwIU2FuZHdhdmUxETAPBgNVBAsM\nCEludGVybmV0MSMwIQYDVQQDDBp3d3cudGVzdGluZ2Fzc2xyZXF1ZXN0LmNvbTEj\nMCEGCSqGSIb3DQEJARYUYXJuby5ib3RAc2FuZHdhdmUuaW8wggEiMA0GCSqGSIb3\nDQEBAQUAA4IBDwAwggEKAoIBAQDGW2yZOov0ug7d3zrnHyJtdegguLcdVSc9sbhg\nqKzwNSyQeVfvLgSqFu8glT28FAPJy1fhNydJm8WUvV29+UdiUIx7a0nWNNsBNRQ2\nglk8g+cklwemyuTPvlhvQC1RtQtoer4ibgd4TjP3/cZLHpakTRZYbz6XIsYOA7si\nlBzMfsxNwuAtB+NvJd9Guscu8yGS3cXG/K9xkQrT/uuTjLoynTjXmZXzHpEDz39/\n60F5aKbkl/OzgUYrct5on/aLUhcv1heoYah6XsxIjrtPpTFMxAA0JR3SGHnCe1rP\nyoPP5k9chQ6q+ljw9/Wgs1iVyl8DJFYWTlI0ztPaEUX+FoDFAgMBAAGgADANBgkq\nhkiG9w0BAQsFAAOCAQEAw8cD4C0yHF+vXBgTkCsclbSVj7chx37Al9qUp7r5dOdS\nsxWPFHZVyfaxWIfh/C1ydAd7gpoW2eyc51qwV0pp2Y20V+cR4PjunO+HErWCSm67\n5HVeqsGYYIW/vL0MbfrYJCSVIVB89UEDTtcZ4vdVAG0D2cwfkBV4qNlg++LATpXn\nILtgC157yLc6E8DVUEgjLEjt/xAsANQb4f0yLVSoeGHPIejRmvVQjTkz5Xk5e6vt\nsKYP2GbIIvy5xXwDKhdGVi5XpNgO5PupJyScU4C9ssLCjcF6l60y8jkZypesUwWH\n9Fh3UbrYKTu5+V99QSNz8sZXIxk2hMnqjDdttpNgtg==\n-----END CERTIFICATE REQUEST-----',
            [],
            'Example',
            'Example department',
            'ExampleStr. 1',
            '1234AB',
            'Amsterdam',
            '12345678',
            'example@mail.com',
            ['test@example.com'],
            'nl',
            'en',
            [
                'commonName' => 'commonname.com',
                'type' => DcvTypeEnum::LOCALE_DNS,
                'email' => 'dcv@mail.com',
            ]
        );

        self::assertInstanceOf(CertificateInfoProcess::class, $processResult);
        self::assertCount(1, $processResult->validations->dcv->toArray());
        self::assertSame(20, $processResult->processId);
    }
}
