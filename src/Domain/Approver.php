<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class Approver implements DomainObjectInterface
{
    private function __construct(
        public string $firstName,
        public string $lastName,
        public ?string $jobTitle,
        public string $email,
        public string $voice
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'jobTitle' => $this->jobTitle,
            'email' => $this->email,
            'voice' => $this->voice,
        ], static function ($value) {
            return ! is_null($value);
        });
    }

    public static function fromArray(array $json): Approver
    {
        return new Approver(
            $json['firstName'],
            $json['lastName'],
            $json['jobTitle'],
            $json['email'],
            $json['voice'],
        );
    }
}
