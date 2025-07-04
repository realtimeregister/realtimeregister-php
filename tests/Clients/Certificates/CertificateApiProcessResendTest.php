<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Clients\Certificates;

use PHPUnit\Framework\TestCase;
use RealtimeRegister\Domain\ResendDcvCollection;
use RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificateApiProcessResendTest extends TestCase
{
    public function test_resend_dcv(): void
    {
        $certificateId = 1;
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../../Domain/data/certificates/certificate_process_resend.php'),
            MockedClientFactory::assertRoute('POST', 'v2/processes/' . $certificateId . '/resend', $this)
        );

        $sdk->certificates->resendDcv(
            1,
            ResendDcvCollection::fromArray(include __DIR__ . '/../../Domain/data/domains/domain_control_validation.php')
        );
    }
}
