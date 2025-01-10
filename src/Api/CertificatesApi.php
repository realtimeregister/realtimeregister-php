<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use DateTimeImmutable;
use RealtimeRegister\Domain\Certificate;
use RealtimeRegister\Domain\CertificateCollection;
use RealtimeRegister\Domain\CertificateInfoProcess;
use RealtimeRegister\Domain\Enum\DownloadFormatEnum;
use RealtimeRegister\Domain\Product;
use RealtimeRegister\Domain\ProductCollection;
use RealtimeRegister\Domain\ResendDcvCollection;

final class CertificatesApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/ssl/get */
    public function getCertificate(int $certificateId): Certificate
    {
        $response = $this->client->get(sprintf('/v2/ssl/certificates/%s', $certificateId));

        return Certificate::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/list */
    public function listCertificates(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): CertificateCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('/v2/ssl/certificates', $query);

        return CertificateCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/download */
    public function downloadCertificate(int $certificateId, string $format = 'CRT'): string
    {
        DownloadFormatEnum::validate($format);

        $response = $this->client->get(sprintf('/v2/ssl/certificates/%s/download', $certificateId), ['format' => $format]);

        return $response->text();
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/dcvemailaddresslist */
    public function listDcvEmailAddresses(string $domainName, string $product = null): array
    {

        $response = $this->client->get(sprintf('/v2/ssl/dcvemailaddresslist/%s', urlencode($domainName)) . ($product ? sprintf('?product=%s', urlencode($product)) : ''));

        return $response->json();
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/products/get */
    public function getProduct(string $product): Product
    {
        $response = $this->client->get(sprintf('/v2/ssl/products/%s', urlencode($product)));

        return Product::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/products/list */
    public function listProducts(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ProductCollection {
        $query = $this->processListQuery($limit, $offset, $search, $parameters);

        $response = $this->client->get('/v2/ssl/products', $query);

        return ProductCollection::fromArray($response->json());
    }

    public function export(array $parameters = []): array
    {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('/v2/ssl/products', $query);
        return $response->json()['entities'];
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/request */
    public function requestCertificate(
        string $customer,
        string $product,
        int $period,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?string $saEmail = null,
        ?array $approver = null,
        ?string $country = null,
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
    ): CertificateInfoProcess {
        $payload = [
            'customer' => $customer,
            'product' => $product,
            'period' => $period,
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($country)) {
            $payload['country'] = $country;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($saEmail)) {
            $payload['saEmail'] = $saEmail;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        $response = $this->client->post('/v2/ssl/certificates', $payload);

        return CertificateInfoProcess::fromArray(array_merge($response->json(), ['headers' => $response->headers()]));
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/renew */
    public function renewCertificate(
        int $certificateId,
        int $period,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?string $saEmail = null,
        ?array $approver = null,
        ?string $country = null, // TODO This field isn't used
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
        ?string $product = null,
    ): CertificateInfoProcess {
        $payload = [
            'period' => $period,
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($country)) {
            trigger_error('Country field is not used in this call and will be removed in a future version');
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($saEmail)) {
            $payload['saEmail'] = $saEmail;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        if (! is_null($product)) {
            $payload['product'] = $product;
        }

        $response = $this->client->post(sprintf('/v2/ssl/certificates/%s/renew', $certificateId), $payload);

        return CertificateInfoProcess::fromArray(array_merge($response->json(), ['headers' => $response->headers()]));
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/reissue */
    public function reissueCertificate(
        int $certificateId,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?array $approver = null,
        ?string $country = null, // TODO This field isn't used
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
    ): CertificateInfoProcess {
        $payload = [
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($country)) {
            trigger_error('Country field is not used in this call and will be removed in a future version');
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        $response = $this->client->post(sprintf('/v2/ssl/certificates/%s/reissue', $certificateId), $payload);

        return CertificateInfoProcess::fromArray(array_merge($response->json(), ['headers' => $response->headers()]));
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/revoke */
    public function revokeCertificate(int $certificateId, ?string $reason = null): void
    {
        $payload = [];

        if (! is_null($reason)) {
            $payload['reason'] = $reason;
        }

        $this->client->delete(sprintf('/v2/ssl/certificates/%s', $certificateId), $payload);
    }

    public function sendSubscriberAgreement(int $processId, string $email, ?string $language): void
    {
        $payload = [
            'email' => $email,
        ];

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        $this->client->post(sprintf('/v2/processes/%s/send-subscriber-agreement', $processId), $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/add-note */
    public function addNote(int $processId, string $message): void
    {
        $payload = [
            'message' => $message,
        ];

        $this->client->post(sprintf('/v2/processes/%s/add-note', $processId), $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/schedule-validation-call */
    public function scheduleValidationCall(int $processId, DateTimeImmutable $date): void
    {
        $payload = [
            'date' => $date,
        ];

        $this->client->post(sprintf('/v2/processes/%s/schedule-validation-call', $processId), $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/processes/info */
    public function info(int $processId): CertificateInfoProcess
    {
        $response = $this->client->get(sprintf('/v2/processes/%s/info', $processId));

        return CertificateInfoProcess::fromArray(array_merge($response->json(), ['headers' => $response->headers()]));

    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/import */
    public function importCertificate(string $customer, string $certificate, ?string $csr, ?string $coc): void
    {
        $payload = [
            'customer' => $customer,
            'certificate' => $certificate,
        ];

        if (! is_null($csr)) {
            $payload['csr'] = $csr;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        $this->client->post('/v2/ssl/import', $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/decocdecsr */
    public function decodeCsr(string $csr): array
    {
        $response = $this->client->post('/v2/ssl/decodecsr', ['csr' => $csr]);

        return $response->json();
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/generate-authkey */
    public function generateAuthKey(string $product, string $csr): array
    {
        $payload = [
            'product' => $product,
            'csr' => $csr,
        ];

        $response = $this->client->post('/v2/ssl/authkey', $payload);

        return $response->json();
    }

    /** @see https://dm.yoursrs-ote.com/docs/api/ssl/resenddcv */
    public function resendDcv(int $processId, ResendDcvCollection $resendDcvCollection): ?array
    {
        $response = $this->client->post(sprintf('/v2/processes/%s/resend', $processId), $resendDcvCollection->toArray());

        if (
            is_array($response->headers()) && array_key_exists('content-type', $response->headers())
            && str_contains($response->headers()['content-type'][0], 'application/json')
        ) {
            return $response->json();
        }
        return null;
    }
}
