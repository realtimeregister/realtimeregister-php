<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataFlagEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataProtocolEnum;

final class KeyData implements DomainObjectInterface
{
    /** @var int */
    public $protocol;

    /** @var int */
    public $flags;

    /** @var int */
    public $algorithm;

    /** @var string */
    public $publicKey;

    private function __construct(int $protocol, int $flags, int $algorithm, string $publicKey)
    {
        $this->protocol = $protocol;
        $this->flags = $flags;
        $this->algorithm = $algorithm;
        $this->publicKey = $publicKey;
    }

    public static function fromArray(array $json): KeyData
    {
        KeyDataProtocolEnum::validate($json['protocol']);
        KeyDataFlagEnum::validate($json['flags']);
        KeyDataAlgorithmEnum::validate($json['algorithm']);

        return new KeyData(
            $json['protocol'],
            $json['flags'],
            $json['algorithm'],
            $json['publicKey']
        );
    }

    public function toArray(): array
    {
        return [
            'protocol' => $this->protocol,
            'flags' => $this->flags,
            'algorithm' => $this->algorithm,
            'publicKey' => $this->publicKey,
        ];
    }
}
