<?php

declare(strict_types=1);


namespace Musement\Application\Query\City\Model\Cities;

use Musement\Application\Query\City\Model\Cities\City\Forecast;

final class City
{
    private string $name;

    private ?Forecast $forecast;

    public function __construct(string $name, ?Forecast $forecast)
    {
        $this->name = $name;
        $this->forecast = $forecast;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function forecast() : ?Forecast
    {
        return $this->forecast;
    }

    public function __toString() : string
    {
        if ($this->forecast === null) {
            return \sprintf(
                '%s | no forecast data',
                $this->name
            );
        }

        return \sprintf(
            '%s | %s - %s',
            $this->name,
            $this->forecast->today(),
            $this->forecast->tomorrow()
        );
    }
}
