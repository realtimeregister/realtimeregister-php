<?php declare(strict_types = 1);

namespace RealtimeRegister\Support;

use RealtimeRegister\Exceptions\UnexpectedValueException;

class RealtimeRegisterResponse
{
    private string $response;

    private array $headers;

    private int $resultCode;

    public function __construct(string $response, array $headers, int $resultCode)
    {
        $this->response = $response;
        $this->headers = $headers;
        $this->resultCode = $resultCode;
    }

    public function __toString(): string
    {
        return $this->text();
    }

    public static function fromString(string $response, array $headers, int $resultCode = -1): RealtimeRegisterResponse
    {
        return new RealtimeRegisterResponse($response, array_change_key_case($headers), $resultCode);
    }

    public function json(): array
    {
        $json = json_decode($this->response, true);

        if (json_last_error() || $json === false) {
            throw new UnexpectedValueException("Could not parse JSON response body:\n" . $this->response);
        }

        return $json;
    }

    public function text(): string
    {
        return $this->response;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function resultCode(): int
    {
        return $this->resultCode;
    }
}
