<?php

declare(strict_types=1);


namespace Musement\Tests\Functional;

use Musement\Tests\Context\ClockContext;
use Musement\Tests\Context\MusementApiContext;
use Musement\Tests\Context\WeatherApiContext;
use Musement\Tests\Stubs\Application\ClockStub;
use Musement\Tests\Stubs\SDK\MusementApi\MusementApiStub;
use Musement\Tests\Stubs\SDK\WeatherApi\WeatherApiStub;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class FunctionalTestCase extends KernelTestCase
{
    protected ClockContext $clockContext;

    protected MusementApiContext $musementApiContext;

    protected WeatherApiContext $weatherApiContext;

    protected function setUp() : void
    {
        parent::setUp();
        $kernel = parent::bootKernel();

        $clockStub = $kernel->getContainer()->get(ClockStub::class);
        $musementApiStub = $kernel->getContainer()->get(MusementApiStub::class);
        $weatherApiStub = $kernel->getContainer()->get(WeatherApiStub::class);

        if (
            !($clockStub instanceof ClockStub)
            || !($musementApiStub instanceof MusementApiStub)
            || !($weatherApiStub instanceof WeatherApiStub)
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
    }

    /**
     * @param string $commandName
     * @param array<mixed> $input
     * @return CommandTester
     */
    protected function executeCommand(string $commandName, array $input = []) : CommandTester
    {
        $application = new Application(parent::$kernel);
        $command = $application->find($commandName);

        $commandTester = new CommandTester($command);
        $commandTester->execute($input);

        return $commandTester;
    }
}
