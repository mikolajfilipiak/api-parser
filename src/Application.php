<?php

declare(strict_types=1);

namespace Musement;

use Musement\Application\Query\City\CityQuery;

final class Application
{
    /**
     * @var CityQuery
     */
    private $query;

    public function __construct(CityQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @return CityQuery
     */
    public function cityQuery() : CityQuery
    {
        return $this->query;
    }
}
