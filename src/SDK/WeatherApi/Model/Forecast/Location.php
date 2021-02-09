<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi\Model\Forecast;

final class Location
{
    private string $name;

    private float $lat;

    private float $lon;

    public function __construct(string $name, float $lat, float $lon)
    {
        $this->name = $name;
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function lat() : float
    {
        return $this->lat;
    }

    public function longitude() : float
    {
        return $this->lon;
    }
}
