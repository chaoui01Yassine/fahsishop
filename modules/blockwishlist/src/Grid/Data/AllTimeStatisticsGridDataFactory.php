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

use PrestaShop\PrestaShop\Core\Grid\Data\Factory\GridDataFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\Data\GridData;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

class AllTimeStatisticsGridDataFactory extends BaseGridDataFactory implements GridDataFactoryInterface
{
    // 1 month
    const CACHE_LIFETIME_SECONDS = 2629746;

    public function getData(SearchCriteriaInterface $searchCriteria)
    {
        if ($this->cache->contains(self::CACHE_KEY_STATS_ALL_TIME . $this->shopId)) {
            $results = $this->cache->fetch(self::CACHE_KEY_STATS_ALL_TIME . $this->shopId);
        } else {
            $results = $this->calculator->computeStatsFor('allTime');
            $this->cache->save(self::CACHE_KEY_STATS_ALL_TIME . $this->shopId, $results, self::CACHE_LIFETIME_SECONDS);
        }

        return new GridData(new RecordCollection($results), count($results));
    }
}
