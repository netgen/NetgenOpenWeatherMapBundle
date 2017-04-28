<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

class UnitsConstraints
{
    /**
     * For temperature in Kelvin
     */
    const STANDARD = 'standard';

    /**
     * For temperature in Celsius
     */
    const METRIC = 'metric';

    /**
     * For temperature in Fahrenheit
     */
    const IMPERIAL = 'imperial';
}
