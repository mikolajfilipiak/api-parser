<?php

declare(strict_types=1);


namespace Musement\SDK\MusementApi;

use Musement\SDK\MusementApi\Model\Cities;
use Symfony\Component\HttpClient\HttpClient;
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
        $response = $this->httpClient->request(
            $method = 'GET',
            $url = '/api/v3/cities',
            [
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new \Exception();
        }

        return new Cities(...\array_map(
            function (array $city) {
                return new Cities\City(
                    $city['name'],
                    $city['latitude'],
                    $city['longitude']
                );
            },
            \json_decode($response->getContent(), true) ?? []
        ));
    }
}
