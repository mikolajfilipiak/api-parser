<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi\Model\Forecast\ForecastDays;

use Musement\SDK\WeatherApi\Model\Forecast\ForecastDays\ForecastDay\Condition;

final class ForecastDay
{
    private string $date;

    private Condition $condition;

    public function __construct(string $date, Condition $condition)
    {
        $this->date = $date;
        $this->condition = $condition;
    }

    public function date() : string
    {
        return $this->date;
    }

    public function condition() : Condition
    {
        return $this->condition;
    }

    public function __toString() : string
    {
        return (string) $this->condition;
    }
}
