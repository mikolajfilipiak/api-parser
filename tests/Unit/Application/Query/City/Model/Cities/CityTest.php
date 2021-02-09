<?php

declare(strict_types=1);


namespace Musement\Tests\Unit\Application\Query\City\Model\Cities;

use Musement\Application\Query\City\Model\Cities\City;
use Musement\Application\Query\City\Model\Cities\City\Forecast;
use Musement\Tests\Unit\UnitTestCase;

final class CityTest extends UnitTestCase
{
    /**
     * @dataProvider forecast_data_provider
     * @param string $name
     * @param City $city
     */
    public function test_to_string_method_with_forecast(string $name, City $city) : void
    {
        $this->assertSame(
            $name,
            (string) $city
        );
    }

    /**
     * @return array<mixed>
     */
    public function forecast_data_provider() : array
    {
        return [
            [
                $name = 'name | today - tomorrow',
                $city = new City(
                    $cityName = 'name',
                    $forecast = new Forecast(
                        $today = 'today',
                        $tomorrow = 'tomorrow'
                    ),
                ),
            ],
            [
                $name = 'name | no forecast data',
                $city = new City(
                    $cityName = 'name',
                    $forecast = null,
                ),
            ],
        ];
    }
}
