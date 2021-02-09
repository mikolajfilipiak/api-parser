<?php

declare(strict_types=1);


namespace Musement\Infrastructure\Utils;

use Musement\Application\Utils\ApplicationClock;

final class Clock implements ApplicationClock
{
    public function getCurrentTime() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
