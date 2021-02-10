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


# Musement Step #2
### endpoint/s to set the forecast for a specific city:

Add forecast for city:
```
POST /api/v3/cities/{id}/forecast/{date}
```
General informations:
1. `date` date should be in `YYYY-mm-dd` format.
2. `date` cannot be earlier than today.

Request Payload:
```json
{
    "forecast": "Partly cloudy"
}
```
Response Payload:

OK response
HTTP Code: 201
```json
{
    "city_id": 43,
    "date": "2021-02-10",
    "forecast": "Partly cloudy"
}
```

Validation errorv | HTTP Code: 400
```json
{
    "message": "[date] should be in YYYY-mm-dd format"
}
```

Already exists:
HTTP Code: 409

Update forecast for city:
```
PUT /api/v3/cities/{id}/forecast/{date}
```
General informations:
1. `date` date should be in `YYYY-mm-dd` format.
2. `date` cannot be earlier than today.

Request Payload:
```json
{
    "forecast": "Partly cloudy"
}
```
Response Payload:

OK response
HTTP Code: 200
```json
{
    "city_id": 43,
    "date": "2021-02-10",
    "forecast": "Partly cloudy"
}
```

Validation errorv | HTTP Code: 400
```json
{
    "message": "[date] should be in YYYY-mm-dd format"
}
```

### endpoint/s to read the forecast for a specific city:
```
GET /api/v3/cities/{id}/forecast/{date}
```
General informations:
1. `date` date should be in `YYYY-mm-dd` format.
2. `date` cannot be earlier than today.

Response Payload:

OK response | HTTP Code: 200
```json
{
    "city_id": 43,
    "date": "2021-02-10",
    "forecast": "Partly cloudy"
}
```

Empty response | HTTP Code: 200
```json
{
    "city_id": 43,
    "date": "2021-02-10",
    "forecast": null
}
```

Validation errorv | HTTP Code: 400
```json
{
    "message": "[date] should be in YYYY-mm-dd format"
}
```

City not found | HTTP Code: 404
```json
{
    "message": "No forecast for this [city]"
}
```
