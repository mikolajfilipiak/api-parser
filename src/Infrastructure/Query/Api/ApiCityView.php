<?php

declare(strict_types=1);


namespace Musement\Infrastructure\Query\Api;

use Musement\Application\Query\City\CityQuery;
use Musement\Application\Query\City\Model\Cities;
use Musement\SDK\MusementApi\Model\Cities\City as CityMusementApi;
use Musement\SDK\MusementApi\MusementApiSDK;
use Musement\SDK\WeatherApi\WeatherApiSDK;

final class ApiCityView implements CityQuery
{
    private MusementApiSDK $musementApi;

    private WeatherApiSDK $weatherApi;

    public function __construct(MusementApiSDK $musementApi, WeatherApiSDK $weatherApi)
    {
        $this->musementApi = $musementApi;
        $this->weatherApi = $weatherApi;
    }

    public function getAllWithTwoDaysForecast() : Cities
    {
        return new Cities(...\array_map(
            function (CityMusementApi $city) {
                $twoDaysForecast = $this->weatherApi->twoDaysForecastForCoords(
                    $city->latitude(),
                    $city->longitude()
                );

                return new Cities\City(
                    $city->name(),
                    $twoDaysForecast ? new Cities\City\Forecast(
                        $twoDaysForecast->today(),
                        $twoDaysForecast->tomorrow()
                    ) : null
                );
            },
            $this->musementApi->cities()->getAll()
        ));
    }
}
