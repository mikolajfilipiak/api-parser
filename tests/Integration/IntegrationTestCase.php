<?php

declare(strict_types=1);


namespace Musement\Tests\Integration;

use Musement\Application;
use Musement\Tests\Context\ApplicationContext;
use Musement\Tests\Context\ClockContext;
use Musement\Tests\Context\MusementApiContext;
use Musement\Tests\Context\WeatherApiContext;
use Musement\Tests\Stubs\Application\ClockStub;
use Musement\Tests\Stubs\SDK\MusementApi\MusementApiStub;
use Musement\Tests\Stubs\SDK\WeatherApi\WeatherApiStub;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class IntegrationTestCase extends KernelTestCase
{
    protected ClockContext $clockContext;

    protected MusementApiContext $musementApiContext;

    protected WeatherApiContext $weatherApiContext;

    protected ApplicationContext $applicationContext;

    protected function setUp() : void
    {
        parent::setUp();
        $kernel = parent::bootKernel();

        $clockStub = $kernel->getContainer()->get(ClockStub::class);
        $musementApiStub = $kernel->getContainer()->get(MusementApiStub::class);
        $weatherApiStub = $kernel->getContainer()->get(WeatherApiStub::class);
        $application = $kernel->getContainer()->get(Application::class);

        if (
            !($clockStub instanceof ClockStub)
            || !($musementApiStub instanceof MusementApiStub)
            || !($weatherApiStub instanceof WeatherApiStub)
            || !($application instanceof Application)
        ) {
            throw new \Exception('Bad argument exception');
        }

        $this->clockContext = new ClockContext(
            $clockStub
        );
        $this->musementApiContext = new MusementApiContext(
            $musementApiStub
        );
        $this->weatherApiContext = new WeatherApiContext(
            $weatherApiStub
        );
        $this->applicationContext = new ApplicationContext(
            $application
        );
    }
}
