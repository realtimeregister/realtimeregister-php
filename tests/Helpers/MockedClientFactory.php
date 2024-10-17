<?php declare(strict_types = 1);

namespace RealtimeRegister\Tests\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use RealtimeRegister\RealtimeRegister;
use RealtimeRegister\Support\AuthorizedClient;

class MockedClientFactory
{
    const API_KEY = 'bigsecretdonttellanyone';

    public static function assertRoute(string $method, string $route, TestCase $testCase, ?array $expectedParameters = null): callable
    {
        return function (RequestInterface $request) use ($method, $route, $testCase, $expectedParameters) {
            $testCase->assertSame(strtoupper($method), strtoupper($request->getMethod()));
            $testCase->assertSame($route, $request->getUri()->getPath());
            $testCase->assertSame('ApiKey ' . static::API_KEY, $request->getHeader('Authorization')[0]);

            if (null !== $expectedParameters) {
                parse_str($request->getUri()->getQuery(), $parameters);
                $testCase->assertSame($expectedParameters, $parameters);
            }
        };
    }

    public static function makeSdk(int $responseCode, string $responseBody, ?callable $assertClosure = null): RealtimeRegister
    {
        $sdk = new RealtimeRegister('bigsecretdonttellanyone');
        $responseClosure = static fn () => new Response($responseCode, [], $responseBody);
        $sdk->setClient(static::makeAuthorizedClient($responseClosure, $assertClosure));
        return $sdk;
    }

    public static function makeMockedSdk(callable $responseClosure, ?callable $assertClosure): RealtimeRegister
    {
        $sdk = new RealtimeRegister('bigsecretdonttellanyone');
        $sdk->setClient(static::makeAuthorizedClient($responseClosure, $assertClosure));
        return $sdk;
    }

    public static function makeAuthorizedClient(callable $responseClosure, ?callable $assertClosure = null, ?LoggerInterface $logger = null): AuthorizedClient
    {
        $fakeClient = new AuthorizedClient('https://example.com/api/v2/', 'bigsecretdonttellanyone', [], $logger);

        $handlerStack = HandlerStack::create(new MockHandler([
            $responseClosure(),
        ]));

        if ($assertClosure !== null) {
            $handlerStack->push(function (callable $handler) use ($assertClosure) {
                return function (RequestInterface $request, $options) use ($handler, $assertClosure) {
                    $assertClosure($request);
                    return $handler($request, $options);
                };
            });
        }

        $fakeClient->setClient(new Client(['handler' => $handlerStack]));

        return $fakeClient;
    }
}
