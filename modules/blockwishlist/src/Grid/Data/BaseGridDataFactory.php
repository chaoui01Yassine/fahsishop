<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\BlockWishList\Grid\Data;

use Doctrine\Common\Cache\CacheProvider;
use PrestaShop\Module\BlockWishList\Calculator\StatisticsCalculator;

class BaseGridDataFactory
{
    const CACHE_KEY_STATS_CURRENT_DAY = 'blockwishlist.stats.currentDay';
    const CACHE_KEY_STATS_CURRENT_MONTH = 'blockwishlist.stats.currentMonth';
    const CACHE_KEY_STATS_CURRENT_YEAR = 'blockwishlist.stats.currentYear';
    const CACHE_KEY_STATS_ALL_TIME = 'blockwishlist.stats.allTime';

    /* @var CacheProvider $cache */
    protected $cache;

    /* @var StatisticsCalculator $calculator */
    protected $calculator;

    /**
     * @var int|null
     */
    protected $shopId;

    public function __construct(CacheProvider $cache, StatisticsCalculator $calculator, $shopId)
    {
        $this->cache = $cache;
        $this->calculator = $calculator;
        $this->shopId = $shopId;
    }
}
