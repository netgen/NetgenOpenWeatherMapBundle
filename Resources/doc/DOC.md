Netgen OpenWeatherMap Bundle documentation
==========================================

Current weather data
--------------------

### Current weather data for one location by city name

### Current weather data for one location by city id

### Current weather data for one location by geographic coordinates

### Current weather data for one location by zip code

### Current weather data for several cities within a rectangle zone

### Current weather data for several cities in cycle

### Current weather data for several cities by city IDs


5 day / 3 hour forecast (in progress)
-------------------------------------

### 5 day / 3 hour forecast data by city name

### 5 day / 3 hour forecast data by city id

### 5 day / 3 hour forecast data by geographic coordinates

16 day / daily forecast (in progress)
-------------------------------------

### 16 day / daily forecast data by city name

### 16 day / daily forecast data by city id

### 16 day / daily forecast data by geographic coordinates

UV Index (in progress)
----------------------

### Ultraviolet index by geographic coordinates

* By calling UltravioletIndex service
```php
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface */
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

### Current weather from one station

* By calling WeatherStations service
```php
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
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
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
$data = $weatherStations->fetchFromSeveralByRectangleZone(
    8.87, 49.07, 65.21, 61.26, 6
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
                'mapZoom': 6 
            }
        )
) }}
```

* Or via Symfony route
```php
/netgen/openweather/weatherstations/stationsrectangle/8.87/49.07/65.21/61.26/6
```

### Current weather from several stations by geo point

* By calling WeatherStations service
```php
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface */
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

### Ozone Data by geographic coordinates

* By calling AirPollution service
```php
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface */
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
/** @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface */
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
