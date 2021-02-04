<?php

declare(strict_types=1);


namespace Musement\SDK\MusementApi\Model;

use Musement\SDK\MusementApi\Model\Cities\City;

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
}
