<?php declare(strict_types = 1);

namespace RealtimeRegister\Api;

use RealtimeRegister\Domain\TLDInfo;

final class TLDsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/tlds/info */
    public function info(string $tld): TLDInfo
    {
        $response = $this->client->get(sprintf('v2/tlds/%s/info', urlencode($tld)));
        return TLDInfo::fromArray($response->json());
    }
}
