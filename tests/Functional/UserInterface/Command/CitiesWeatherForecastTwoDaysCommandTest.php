<?php

declare(strict_types=1);


namespace Musement\Tests\Functional\UserInterface\Command;

use Musement\SDK\MusementApi\Model\Cities;
use Musement\SDK\WeatherApi\Exception\NotFoundException;
use Musement\SDK\WeatherApi\Model\Forecast;
use Musement\SDK\WeatherApi\Model\Forecast\ForecastDays;
use Musement\Tests\Functional\FunctionalTestCase;

final class CitiesWeatherForecastTwoDaysCommandTest extends FunctionalTestCase
{
    public function test_process_empty_cities_response() : void
    {
        $commandTester = $this->executeCommand(
            $name = 'cities:weather-forecast:two-days'
        );

        $this->assertStringContainsString(
            'There is no processed cities.',
            $commandTester->getDisplay()
        );
    }

    public function test_process_cities_with_no_forecast() : void
    {
        $this->weatherApiContext->setException(
            new NotFoundException()
        );
        $this->musementApiContext->setCities(
            new Cities(
                $city = new Cities\City(
                    $cityName = \uniqid('name-'),
                    $latitude = \rand(0, 10) / 10,
                    $longitude = \rand(0, 10) / 10
                )
            )
        );

        $commandTester = $this->executeCommand(
            $name = 'cities:weather-forecast:two-days'
        );

        $this->assertStringContainsString(
            \sprintf(
                'Processed city %s | no forecast data',
                $cityName
            ),
            $commandTester->getDisplay()
        );
    }

    public function test_process_cities_forecast() : void
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

        $commandTester = $this->executeCommand(
            $name = 'cities:weather-forecast:two-days'
        );

        $this->assertStringContainsString(
            \sprintf(
                'Processed city %s | %s - %s',
                $cityName,
                $todayCondition,
                $tomorrowCondition
            ),
            $commandTester->getDisplay()
        );
    }
}
