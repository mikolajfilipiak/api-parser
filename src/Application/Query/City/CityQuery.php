<?php

declare(strict_types=1);


namespace Musement\Application\Query\City;

use Musement\Application\Query\City\Model\Cities;
use Musement\Application\Query\Query;

interface CityQuery extends Query
{
    public function getAllWithTwoDaysForecast() : Cities;
}
