<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

class SearchAccuracyConstraints
{
    /**
     * Returns exact match values.
     */
    const ACCURATE = 'accurate';

    /**
     * Returns results by searching for that substring.
     */
    const LIKE = 'like';
}
