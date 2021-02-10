<?php

declare(strict_types=1);


namespace Musement\SDK\MusementApi;

use Musement\SDK\MusementApi\Exception\MalformedResponseException;
use Musement\SDK\MusementApi\Exception\NotFoundException;
use Musement\SDK\MusementApi\Exception\ResponseException;
use Musement\SDK\MusementApi\Model\Cities;
use Musement\Shared\ArrayAccessor\ArrayAccessor;
use Musement\Shared\ArrayAccessor\Exception\InvalidTypeException;
use Musement\Shared\ArrayAccessor\Exception\KeyNotExistException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class MusementApi implements MusementApiSDK
{
    private HttpClientInterface $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::createForBaseUri('https://api.musement.com');
    }

    public function cities() : Cities
    {
        try {
            $response = $this->httpClient->request(
                $method = 'GET',
                $url = '/api/v3/cities',
                [
                    'headers' => ['Accept' => 'application/json'],
                ]
            );

            if ($response->getStatusCode() === 404) {
                throw new NotFoundException(
                    $message = 'Resource not found',
                    $response->getStatusCode()
                );
            } elseif ($response->getStatusCode() !== 200) {
                throw new ResponseException(
                    $message = 'Bad response code',
                    $response->getStatusCode()
                );
            }

            return new Cities(...\array_map(
                function (array $city) {
                    return new Cities\City(
                        ArrayAccessor::string($city, 'name'),
                        ArrayAccessor::float($city, 'latitude'),
                        ArrayAccessor::float($city, 'longitude')
                    );
                },
                \json_decode($response->getContent(), true) ?? []
            ));
        } catch (TransportExceptionInterface $exception) {
            throw new ResponseException(
                $message = 'Transport Exception',
                $exception->getCode(),
                $exception
            );
        } catch (KeyNotExistException|InvalidTypeException $exception) {
            throw new MalformedResponseException(
                $message = 'Malformed Response Exception',
                $exception->getCode(),
                $exception
            );
        }
    }
}
