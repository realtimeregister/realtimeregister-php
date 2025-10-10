<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class Locale implements DomainObjectInterface {
    public string $code;
    public string $name;

    private function __construct(string $code, string $name) {
        $this->code = $code;
        $this->name = $name;
    }

    public static function fromArray(array $json)
    {
        return new Locale($json['code'], $json['name']);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}
