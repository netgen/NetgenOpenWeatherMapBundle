<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UltravioletIndexController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class UltravioletIndexController extends Controller
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface
     */
    protected $ultravioletIndex;

    /**
     * UltravioletIndexController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface $ultravioletIndex
     */
    public function __construct(UltravioletIndexInterface $ultravioletIndex)
    {
        $this->ultravioletIndex = $ultravioletIndex;
    }
}
