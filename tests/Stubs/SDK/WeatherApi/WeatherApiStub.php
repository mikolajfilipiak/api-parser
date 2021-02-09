<?php

declare(strict_types=1);


namespace Musement\Tests\Stubs\SDK\WeatherApi;

use Musement\SDK\WeatherApi\Model\Forecast;
use Musement\SDK\WeatherApi\WeatherApiSDK;

final class WeatherApiStub implements WeatherApiSDK
{
    private Forecast $forecast;

    private ?\Exception $exception = null;

    public function forecastForCoords(float $latitude, float $longitude, int $days) : Forecast
    {
        if ($this->exception) {
            throw $this->exception;
        }

        return $this->forecast;
    }

    public function setForecast(Forecast $forecast) : void
    {
        $this->forecast = $forecast;
    }

    public function setException(?\Exception $exception) : void
    {
        $this->exception = $exception;
    }
}
