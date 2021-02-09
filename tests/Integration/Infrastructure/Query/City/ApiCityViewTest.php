<?php

declare(strict_types=1);


namespace Musement\Tests\Integration\Infrastructure\Query\City;

use Musement\SDK\MusementApi\Exception\NotFoundException as MusementApiNotFoundException;
use Musement\SDK\MusementApi\Model\Cities;
use Musement\SDK\WeatherApi\Exception\NotFoundException as WeatherApiNotFoundException;
use Musement\SDK\WeatherApi\Model\Forecast;
use Musement\SDK\WeatherApi\Model\Forecast\ForecastDays;
use Musement\Tests\Integration\IntegrationTestCase;

final class ApiCityViewTest extends IntegrationTestCase
{
    public function test_get_all_two_days_forecast_on_musment_not_found_exception() : void
    {
        $this->musementApiContext->setException(
            new MusementApiNotFoundException()
        );

        $cities = $this->applicationContext->application()
            ->cityQuery()
            ->getAllWithTwoDaysForecast();

        $this->assertSame(
            $noCities = 0,
            $cities->count()
        );

        $this->assertEmpty(
            $cities->getAll()
        );
    }

    public function test_get_all_two_days_forecast_on_weather_not_found_exception() : void
    {
        $this->weatherApiContext->setException(
            new WeatherApiNotFoundException()
        );
        $this->musementApiContext->setCities(
            $cities = new Cities(
                $city = new Cities\City(
                    $cityName = \uniqid('name-'),
                    $latitude = \rand(0, 10) / 10,
                    $longitude = \rand(0, 10) / 10
                )
            )
        );

        $allCities = $this->applicationContext->application()
            ->cityQuery()
            ->getAllWithTwoDaysForecast();

        $this->assertNotNull(
            $allCities->first()
        );

        $this->assertSame(
            (string) $allCities->first(),
            \sprintf(
                '%s | no forecast data',
                $cityName
            )
        );
    }

    public function test_get_all_two_days_forecast() : void
    {
        $this->clockContext->setCurrentTime(
            $now = new \DateTimeImmutable('01-01-2021')
        );
        $this->weatherApiContext->setForecast(
            new Forecast(
                new Forecast\Location(
                    $cityName = \uniqid('name-'),
                    $latitude = \rand(0, 10) / 10,
                    $longitude = \rand(0, 10) / 10
                ),
                new ForecastDays(
                    $today = new ForecastDays\ForecastDay(
                        $now->format('Y-m-d'),
                        new ForecastDays\ForecastDay\Condition(
                            $todayCondition = \uniqid('condition-')
                        )
                    ),
                    $tomorrow = new ForecastDays\ForecastDay(
                        $now->add(new \DateInterval('P1D'))->format('Y-m-d'),
                        new ForecastDays\ForecastDay\Condition(
                            $tomorrowCondition = \uniqid('condition-')
                        )
                    ),
                )
            )
        );
        $this->musementApiContext->setCities(
            new Cities(
                $city = new Cities\City(
                    $cityName,
                    $latitude,
                    $longitude
                )
            )
        );

        $allCities = $this->applicationContext->application()
            ->cityQuery()
            ->getAllWithTwoDaysForecast();

        $this->assertNotNull(
            $allCities->first()
        );

        $this->assertSame(
            (string) $allCities->first(),
            \sprintf(
                '%s | %s - %s',
                $cityName,
                $todayCondition,
                $tomorrowCondition
            )
        );
    }
}
