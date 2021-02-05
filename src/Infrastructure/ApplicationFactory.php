<?php

declare(strict_types=1);


namespace Musement\Infrastructure;

use Musement\Application;
use Musement\Infrastructure\Query\City\ApiCityView;
use Musement\SDK\MusementApi\MusementApiSDK;
use Musement\SDK\WeatherApi\WeatherApiSDK;

final class ApplicationFactory
{
    private MusementApiSDK $musementApi;

    private WeatherApiSDK $weatherApi;

    public function __construct(MusementApiSDK $musementApi, WeatherApiSDK $weatherApi)
    {
        $this->musementApi = $musementApi;
        $this->weatherApi = $weatherApi;
    }

    public function __invoke() : Application
    {
        return new Application(
            new ApiCityView(
                $this->musementApi,
                $this->weatherApi
            )
        );
    }
}
