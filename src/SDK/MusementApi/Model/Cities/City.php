<?php

declare(strict_types=1);


namespace Musement\SDK\MusementApi\Model\Cities;

final class City
{
    private string $name;

    private float $latitude;

    private float $longitude;

    public function __construct(string $name, float $latitude, float $longitude)
    {
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function latitude() : float
    {
        return $this->latitude;
    }

    public function longitude() : float
    {
        return $this->longitude;
    }
}
