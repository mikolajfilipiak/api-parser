<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi\Model;

use Musement\SDK\WeatherApi\Model\Forecast\ForecastDays;
use Musement\SDK\WeatherApi\Model\Forecast\Location;

final class Forecast
{
    private Location $location;

    private ForecastDays $forecastDays;

    public function __construct(Location $location, ForecastDays $forecastDays)
    {
        $this->location = $location;
        $this->forecastDays = $forecastDays;
    }

    public function location() : Location
    {
        return $this->location;
    }

    public function forecastDays() : ForecastDays
    {
        return $this->forecastDays;
    }
}
