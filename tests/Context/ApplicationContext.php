<?php

declare(strict_types=1);


namespace Musement\Tests\Context;

use Musement\Application;

final class ApplicationContext
{
    private Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function application() : Application
    {
        return $this->application;
    }
}
