<?php

declare(strict_types=1);


namespace Musement\Application\Query\City\Model;

use Musement\Application\Query\City\Model\Cities\City;

final class Cities
{
    /** @var City[] */
    private array $cities;

    public function __construct(City ...$cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return array<City>
     */
    public function getAll() : array
    {
        return $this->cities;
    }

    public function first() : ?City
    {
        if (!empty($this->cities)) {
            return \reset($this->cities);
        }

        return null;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return \count($this->cities);
    }
}
