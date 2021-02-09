<?php

declare(strict_types=1);


namespace Musement\SDK\WeatherApi\Model\Forecast;

use Musement\SDK\WeatherApi\Model\Forecast\ForecastDays\ForecastDay;

final class ForecastDays
{
    /**
     * @var ForecastDay[] $forecastDays
     */
    private array $forecastDays;

    public function __construct(ForecastDay ...$forecastDays)
    {
        $this->forecastDays = $forecastDays;
    }

    /**
     * @return array<ForecastDay>
     */
    public function getAll() : array
    {
        return $this->forecastDays;
    }

    public function first() : ?ForecastDay
    {
        if (!empty($this->forecastDays)) {
            return \reset($this->forecastDays);
        }
        
        return null;
    }

    public function count() : int
    {
        return count($this->forecastDays);
    }

    public function filterByDate(string $date) : self
    {
        return new self(...\array_filter(
            $this->forecastDays,
            function (ForecastDay $forecastDay) use ($date) {
                return $forecastDay->date() === $date;
            }
        ));
    }
}
