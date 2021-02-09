<?php

declare(strict_types=1);


namespace Musement\Tests\Stubs\Application;

use Musement\Application\Utils\ApplicationClock;

final class ClockStub implements ApplicationClock
{
    private \DateTimeImmutable $currentTime;

    public function __construct()
    {
        $this->currentTime = new \DateTimeImmutable();
    }

    public function getCurrentTime() : \DateTimeImmutable
    {
        return $this->currentTime;
    }

    public function setCurrentTime(\DateTimeImmutable $currentTime) : void
    {
        $this->currentTime = $currentTime;
    }
}
