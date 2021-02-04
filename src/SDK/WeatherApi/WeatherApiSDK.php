<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi;

use Musement\SDK\WeatherApi\Model\TwoDaysForecast;

interface WeatherApiSDK
{
    public function twoDaysForecastForCoords(float $latitude, float $longitude) : ?TwoDaysForecast;
}
