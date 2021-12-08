# Musement Step #1

## Environment
*PHP 7.4*

*Composer 2*

## Installation
Just run:

`cp .env .env.local`

Set variable `WEATHER_API_KEY` in `.env.local` file

`composer install`

## Testing

Just run:
`composer tests`

There is *PHPUnit*, *PHPStan*, *PHP-CS-FIX*

## Command

`bin/console cities:weather-forecast:two-days --env=prod`
