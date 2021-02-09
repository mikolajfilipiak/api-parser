<?php

declare(strict_types=1);


namespace Musement\Application\Utils;

interface ApplicationClock
{
    public function getCurrentTime() : \DateTimeImmutable;
}
