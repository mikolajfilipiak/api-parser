<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi;

use Musement\SDK\WeatherApi\Model\TwoDaysForecast;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class WeatherApi implements WeatherApiSDK
{
    private string $apiKey;

    private HttpClientInterface $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = HttpClient::createForBaseUri('http://api.weatherapi.com');
    }

    public function twoDaysForecastForCoords(float $latitude, float $longitude) : ?TwoDaysForecast
    {
        $response = $this->httpClient->request(
            $method = 'GET',
            \sprintf(
                $url = '/v1/forecast.json?key=%s&q=%s,%s&days=2',
                $this->apiKey,
                $latitude,
                $longitude
            ),
            [
                'headers' => ['Accept' => 'application/json'],
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new \Exception();
        }

        $data = \json_decode($response->getContent(), true) ?? [];

        if (
            !isset($data['forecast']['forecastday'][0]['day']['condition']['text'])
            || !isset($data['forecast']['forecastday'][1]['day']['condition']['text'])
        ) {
            return null;
        }

        return new TwoDaysForecast(
            $data['forecast']['forecastday'][0]['day']['condition']['text'],
            $data['forecast']['forecastday'][1]['day']['condition']['text']
        );
    }
}
