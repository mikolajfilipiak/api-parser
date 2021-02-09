<?php

declare(strict_types=1);


namespace Musement\Infrastructure;

use Musement\Application;
use Musement\Application\Utils\ApplicationClock;
use Musement\Infrastructure\Query\City\ApiCityView;
use Musement\SDK\MusementApi\MusementApiSDK;
use Musement\SDK\WeatherApi\WeatherApiSDK;

final class ApplicationFactory
{
    private MusementApiSDK $musementApi;

    private WeatherApiSDK $weatherApi;

    private ApplicationClock $applicationClock;

    public function __construct(MusementApiSDK $musementApi, WeatherApiSDK $weatherApi, ApplicationClock $applicationClock)
    {
        $this->musementApi = $musementApi;
        $this->weatherApi = $weatherApi;
        $this->applicationClock = $applicationClock;
    }

    public function __invoke() : Application
    {
        return new Application(
            new ApiCityView(
                $this->musementApi,
                $this->weatherApi,
                $this->applicationClock
            )
        );
    }
}
