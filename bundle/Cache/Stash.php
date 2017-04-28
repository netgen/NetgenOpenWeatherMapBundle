<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Exception\ItemNotFoundException;
use Tedivm\StashBundle\Service\CacheService;

class Stash implements HandlerInterface
{
    /**
     * @var \Tedivm\StashBundle\Service\CacheService
     */
    protected $cacheService;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * Stash constructor.
     *
     * @param \Tedivm\StashBundle\Service\CacheService $cacheService
     * @param int $ttl
     */
    public function __construct(CacheService $cacheService, $ttl)
    {
        $this->cacheService = $cacheService;
        $this->ttl = $ttl;
    }

    /**
     * {@inheritdoc}
     */
    public function has($cacheKey)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        return $this->cacheService->hasItem($cacheKey);
    }

    /**
     * {@inheritdoc}
     */
    public function get($cacheKey)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        $item = $this->cacheService->getItem($cacheKey);

        if ($item->isHit()) {
            return $item->get();
        }

        throw new ItemNotFoundException("Item with key:{$cacheKey} not found.");
    }

    /**
     * {@inheritdoc}
     */
    public function set($cacheKey, $data)
    {
        $cacheKey = self::CACHE_KEY_PREFIX . $cacheKey;

        $item = $this->cacheService->getItem($cacheKey);
        $item->set($data);
        $item->expiresAfter($this->ttl);

        $this->cacheService->save($item);
    }
}
