<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi;

use Musement\SDK\WeatherApi\Model\Forecast;

interface WeatherApiSDK
{
    public function forecastForCoords(float $latitude, float $longitude, int $days) : Forecast;
}
