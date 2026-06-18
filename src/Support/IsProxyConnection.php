<?php declare(strict_types = 1);

namespace RealtimeRegister\Support;

/** @codeCoverageIgnore */
class IsProxyConnection
{
    protected string $apiKey;

    protected string $host;

    protected int $port;

    /** @var resource */
    protected $socket;

    public function __construct(string $apiKey, string $host = 'is.yoursrs.com', int $port = 2001)
    {
        $this->apiKey = $apiKey;
        $this->host = $host;
        $this->port = $port;
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect(): bool
    {
        $socket = @fsockopen($this->host, $this->port, $errno, $errstr, 10);
        if (! is_resource($socket)) {
            return false;
        }

        $this->socket = $socket;

        if (! $this->upgradeToTls()) {
            return false;
        }

        return $this->login();
    }

    public function disconnect(): void
    {
        if (! $this->isConnected()) {
            return;
        }

        $this->write('CLOSE');

        @fclose($this->socket);
    }

    public function write(string $message): bool
    {
        if (! $this->isConnected()) {
            $this->connect();
        }

        return @fputs($this->socket, $message . "\r\n") !== false;
    }

    public function read(): string
    {
        if (! $this->isConnected()) {
            $this->connect();
        }

        if (! $response = fgets($this->socket, 1024)) {
            return '';
        }

        return trim($response);
    }

    public function isConnected(): bool
    {
        return is_resource($this->socket);
    }

    protected function login(): bool
    {
        if (! $this->write('LOGIN ' . $this->apiKey)) {
            return false;
        }

        $response = $this->read();
        if (preg_match('#^400\sLogin\sfailed#', $response)) {
            return false;
        }

        return (bool) preg_match('#^100\sLogin\sok#', $response);
    }

    protected function upgradeToTls(): bool
    {
        if (! $this->write('STARTTLS')) {
            return false;
        }

        $response = $this->read();
        if (! preg_match('#^100\sOK#', $response)) {
            return true;
        }

        $methods = STREAM_CRYPTO_METHOD_TLS_CLIENT;

        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
            $methods |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
        }

        if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
            $methods |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
        }

        return @stream_socket_enable_crypto($this->socket, true, $methods) === true;
    }
}
