<?php

declare(strict_types=1);


namespace Musement\Tests\Context;

use Musement\Tests\Stubs\Application\ClockStub;

final class ClockContext
{
    private ClockStub $clockStub;

    public function __construct(ClockStub $clockStub)
    {
        $this->clockStub = $clockStub;
    }

    public function setCurrentTime(\DateTimeImmutable $currentTime) : void
    {
        $this->clockStub->setCurrentTime($currentTime);
    }
}
