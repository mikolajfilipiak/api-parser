<?php

declare(strict_types=1);


namespace Musement\Infrastructure\Query\City;

use Musement\Application\Query\City\CityQuery;
use Musement\Application\Query\City\Model\Cities;
use Musement\Application\Utils\ApplicationClock;
use Musement\SDK\MusementApi\Exception\NotFoundException as MusementApiNotFoundException;
use Musement\SDK\MusementApi\Model\Cities\City as CityMusementApi;
use Musement\SDK\MusementApi\MusementApiSDK;
use Musement\SDK\WeatherApi\Exception\NotFoundException as WeatherApiNotFoundException;
use Musement\SDK\WeatherApi\WeatherApiSDK;

final class ApiCityView implements CityQuery
{
    private MusementApiSDK $musementApi;

    private WeatherApiSDK $weatherApi;

    private ApplicationClock $clock;

    public function __construct(MusementApiSDK $musementApi, WeatherApiSDK $weatherApi, ApplicationClock $clock)
    {
        $this->musementApi = $musementApi;
        $this->weatherApi = $weatherApi;
        $this->clock = $clock;
    }

    public function getAllWithTwoDaysForecast() : Cities
    {
        try {
            $cities = $this->musementApi->cities()->getAll();
        } catch (MusementApiNotFoundException $exception) {
            $cities = [];
        } finally {
            return new Cities(...\array_map(
                function (CityMusementApi $city) {
                    return new Cities\City(
                        $city->name(),
                        $this->getTwoDaysForecastForCoords(
                            $city->latitude(),
                            $city->longitude()
                        )
                    );
                },
                $cities
            ));
        }
    }

    private function getTwoDaysForecastForCoords(float $latitude, float $longitude) : ?Cities\City\Forecast
    {
        try {
            $weatherApiTwoDaysForecast = $this->weatherApi->forecastForCoords(
                $latitude,
                $longitude,
                $days = 2
            );

            $todayForecast = $weatherApiTwoDaysForecast->forecastDays()->filterByDate(
                $today = $this->clock->getCurrentTime()
                    ->format('Y-m-d')
            )->first();

            $tomorrowForecast = $weatherApiTwoDaysForecast->forecastDays()->filterByDate(
                $tomorrow = $this->clock->getCurrentTime()
                    ->add(new \DateInterval('P1D'))
                    ->format('Y-m-d')
            )->first();

            if ($todayForecast && $tomorrowForecast) {
                return new Cities\City\Forecast(
                    (string) $todayForecast,
                    (string) $tomorrowForecast
                );
            }

            return null;
        } catch (WeatherApiNotFoundException $exception) {
            return null;
        }
    }
}
