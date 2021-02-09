<?php

declare(strict_types=1);


namespace Musement\Tests\Context;

use Musement\SDK\WeatherApi\Model\Forecast;
use Musement\Tests\Stubs\SDK\WeatherApi\WeatherApiStub;

final class WeatherApiContext
{
    private WeatherApiStub $weatherApiStub;

    public function __construct(WeatherApiStub $weatherApiStub)
    {
        $this->weatherApiStub = $weatherApiStub;
    }

    public function setForecast(Forecast $forecast) : void
    {
        $this->weatherApiStub->setForecast($forecast);
    }

    public function setException(?\Exception $exception) : void
    {
        $this->weatherApiStub->setException($exception);
    }
}
