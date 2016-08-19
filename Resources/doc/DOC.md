Netgen OpenWeatherMap Bundle documentation
==========================================

Current weather data
--------------------

For more details please check [here](http://openweathermap.org/current).

### Current weather data for one location by city name

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataByCityName(
    'London'
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byCityName',
            { 
                'cityName': 'London'
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/cityname/London
```

### Current weather data for one location by city id

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataByCityId(
    2172797
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byCityId',
            { 
                'cityId': '2172797
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/cityid/2172797
```

### Current weather data for one location by geographic coordinates

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataByGeographicCoordinates(
    35, 139
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byGeographicCoordinates',
            { 
                'latitude': 35,
                'longitude': 139
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/coordinates/35/139
```

### Current weather data for one location by zip code

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataByZipCode(
    94040
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byZipCode',
            { 
                'zipCode': 94040
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/zipcode/94040/us
```

### Current weather data for several cities within a rectangle zone

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataForCitiesWithinRectangleZone(
    array(12, 32, 15, 37, 10), 'yes'
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byRectangleZone',
            { 
                'longitudeLeft': 12,
                'latitudeBottom': 32,
                'logitudeRigth': 15,
                'latitudeTop': 37,
                'mapZoom': 10,
                'cluster': 'yes'
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/rectanglezone/12/32/15/37/10/yes
```

### Current weather data for several cities in cycle

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataForCitiesInCycle(
    55.5, 37.5, 'yes', 10
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather:byCircle',
            { 
                'latitude': 55.5,
                'longitude': 37.5,
                'cluster': 'yes',
                'numberOfCities': 10
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weather/circle/55.5/37.5/yes/10
```

### Current weather data for several cities by city IDs

* By calling Weather service
```php
/** @var $weather \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface */
$data = $weather->fetchWeatherDataForSeveralCityIds(
    array(524901, 703448, 2643743)
);

```

* Or via Symfony route
```php
netgen/openweather/weather/cityids?cities=524901,703448,2643743
```


5 day / 3 hour forecast
-------------------------------------

For more details please check [here](http://openweathermap.org/forecast5).

### 5 day / 3 hour forecast data by city name

* By calling HourForecast service
```php
/** @var $hourForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface */
$data = $hourForecast->fetchForecastByCityName(
    'London'
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.hour_forecast:getForecastByCityName',
            { 
                'cityName': 'London'
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/hourforecast/cityname/London
```

### 5 day / 3 hour forecast data by city id

* By calling HourForecast service
```php
/** @var $hourForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface */
$data = $hourForecast->fetchForecastByCityId(
    524901
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.hour_forecast:getForecastByCityId',
            { 
                'cityId': 524901
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/hourforecast/cityid/524901
```

### 5 day / 3 hour forecast data by geographic coordinates

* By calling HourForecast service
```php
/** @var $hourForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface */
$data = $hourForecast->fetchForecastByCityGeographicCoordinates(
    35, 139
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.hour_forecast:getForecastByCityGeographicCoordinates',
            { 
                'latitude': 35,
                'longitude': 139
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/hourforecast/geocoords/35/139
```

16 day / daily forecast
-------------------------------------

For more details please check [here](http://openweathermap.org/forecast16).

### 16 day / daily forecast data by city name

* By calling DailyForecast service
```php
/** @var $dailyForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface */
$data = $dailyForecast->fetchForecastByCityName(
    'London'
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.daily_forecast:getForecastByCityName',
            { 
                'cityName': 'London'
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/dailyforecast/cityname/London
```

### 16 day / daily forecast data by city id

* By calling DailyForecast service
```php
/** @var $dailyForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface */
$data = $dailyForecast->fetchForecastByCityId(
    524901
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.daily_forecast:getForecastByCityId',
            { 
                'cityId': 524901
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/dailyforecast/cityid/524901
```

### 16 day / daily forecast data by geographic coordinates

* By calling DailyForecast service
```php
/** @var $dailyForecast \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface */
$data = $dailyForecast->fetchForecastByCityGeographicCoordinates(
    55, 37
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.daily_forecast:getForecastByCityGeographicCoordinates',
            { 
                'latitude': 55,
                'longitude': 37
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/dailyforecast/geocoords/55/37
```

UV Index
----------------------

For more details please check [here](http://openweathermap.org/api/uvi).

### Ultraviolet index by geographic coordinates

* By calling UltravioletIndex service
```php
/** @var $ultravioletIndex \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface */
$data = $ultravioletIndex->fetchUltraviletIndex(
    55, 37
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.ultraviolet_index:getUltravioletIndex',
            { 
                'latitude': 55,
                'longitude': 37
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/ultravioletindex/55/37
```

Weather stations
------------------------------

For more details please check [here](http://openweathermap.org/api_station).

### Current weather from one station

* By calling WeatherStations service
```php
/** @var $weatherStations \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
$data = $weatherStations->fetchFromOnStationById(29584);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather_stations:getFromOnStationById', 
            { 'stationId': 29584 }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weatherstations/station/29584
```

### Current weather from several stations by rectangle zone

* By calling WeatherStations service
```php
/** @var $weatherStations \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
$data = $weatherStations->fetchFromSeveralByRectangleZone(
    array(8.87, 49.07, 65.21, 61.26, 6), 'yes', 10
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather_stations:getFromSeveralByRectangleZone',
            { 
                'longitudeTopLeft': 8.87,
                'latitudeTopLeft': 49.07,
                'longitudeBottomRight': 65.21,
                'latitudeBottomRight': 61.26,
                'mapZoom': 6,
                'cluster': 'yes', 
                'numberOfStations': 10
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weatherstations/stationsrectangle/8.87/49.07/65.21/61.26/6/yes/10
```

### Current weather from several stations by geo point

* By calling WeatherStations service
```php
/** @var $weatherStations \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
$data = $weatherStations->fetchFromSeveralByGeoPoint(
    55, 37
);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.weather_stations:getFromSeveralByGeoPoint',
            { 
                'latitude': 55,
                'longitude': 37
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weatherstations/stationsgeopoint/55/37
```

Air pollution
---------------------------

For details about CO check [here](http://openweathermap.org/api/pollution/co) and for [ozone](http://openweathermap.org/api/pollution/o3).

### Ozone Data by geographic coordinates

* By calling AirPollution service
```php
/** @var $airPollution \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface */
$data = $airPollution->fetchOzoneData(35, 139);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.air_pollution:getOzoneData', 
            { 'latitude': 35, 'longitude: '139' }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/airpollution/ozone/35/139
```

### Carbon Monoxide Data by geographic coordinates

* By calling AirPollution service
```php
/** @var $airPollution \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface */
$data = $airPollution->fetchCarbonMonoxideData(35, 139);

```

* By rendering controller inside template
```jinja
{{ render(
    controller(
        'netgen_open_weather_map.controller.air_pollution:getCarbonMonoxideData', 
            { 'latitude': 35, 'longitude: '139' }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/airpollution/carbonmonoxide/35/139
```
