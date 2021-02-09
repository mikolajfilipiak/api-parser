<?php

declare(strict_types=1);

namespace Musement\UserInterface\Command;

use Musement\Application;
use Musement\Application\Query\City\Model\Cities\City;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CitiesWeatherForecastTwoDaysCommand extends Command
{
    protected static $defaultName = 'cities:weather-forecast:two-days';

    private Application $application;

    public function __construct(Application $application)
    {
        parent::__construct(self::$defaultName);

        $this->application = $application;
    }

    protected function configure() : void
    {
        $this->setDescription('Get list of cities with two days weather forecast.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $citiesWithTwoDaysForecast = $this->application
            ->cityQuery()
            ->getAllWithTwoDaysForecast();

        if (!$citiesWithTwoDaysForecast->count()) {
            $output->writeln('There is no processed cities.');

            return Command::FAILURE;
        }

        \array_map(
            function (City $city) use ($output) {
                $output->writeln(\sprintf(
                    'Processed city %s',
                    (string) $city
                ));
            },
            $citiesWithTwoDaysForecast->getAll()
        );

        return Command::SUCCESS;
    }
}
