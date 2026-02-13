<?php

namespace RealtimeRegister\Domain;

class Approver implements DomainObjectInterface
{
    public string $firstName;

    public string $lastName;

    public ?string $jobTitle;

    public string $email;

    public string $voice;

    private function __construct(
        string $firstName,
        string $lastName,
        ?string $jobTitle,
        string $email,
        string $voice
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->jobTitle = $jobTitle;
        $this->email = $email;
        $this->voice = $voice;
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
            return !is_null($value);
        });
    }

    public static function fromArray(array $json)
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
