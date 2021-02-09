<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi\Model\Forecast\ForecastDays\ForecastDay;

final class Condition
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function text() : string
    {
        return $this->text;
    }

    public function __toString() : string
    {
        return $this->text;
    }
}
