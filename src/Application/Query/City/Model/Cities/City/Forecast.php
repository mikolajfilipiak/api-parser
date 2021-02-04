<?php

declare(strict_types=1);


namespace Musement\Application\Query\City\Model\Cities\City;

final class Forecast
{
    private string $today;

    private string $tomorrow;

    public function __construct(string $today, string $tomorrow)
    {
        $this->today = $today;
        $this->tomorrow = $tomorrow;
    }

    public function today() : string
    {
        return $this->today;
    }

    public function tomorrow() : string
    {
        return $this->tomorrow;
    }
}
