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

Weather stations (in progress)
------------------------------

### Current weather from one station

### Current weather from several stations by rectangle zone

### Current weather from several stations by geo point

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
{{ render(controller('netgen_open_weather_map.controller.air_pollution:getOzoneData', { 'latitude': 35, 'longitude: '139' })) }}
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
{{ render(controller('netgen_open_weather_map.controller.air_pollution:getCarbonMonoxideData', { 'latitude': 35, 'longitude: '139' })) }}
```

* Or via Symfony route
```php
/netgen/openweather/airpollution/carbonmonoxide/35/139
```
