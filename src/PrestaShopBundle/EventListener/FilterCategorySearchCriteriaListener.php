<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade fahsishop to newer
 * versions in the future. If you wish to customize fahsishop for your
 * needs please refer to https://fahsishop.com/ for more information.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShopBundle\EventListener;

use PrestaShop\PrestaShop\Core\Grid\Search\Factory\DecoratedSearchCriteriaFactory;
use PrestaShop\PrestaShop\Core\Search\Filters\CategoryFilters;
use PrestaShopBundle\Event\FilterSearchCriteriaEvent;

/**
 * Class FilterCategorySearchCriteriaListener updates category search criteria filters with resolved category parent id.
 */
class FilterCategorySearchCriteriaListener
{
    /**
     * @var DecoratedSearchCriteriaFactory
     */
    private $categorySearchCriteriaFactory;

    /**
     * @param DecoratedSearchCriteriaFactory $categorySearchCriteriaFactory
     */
    public function __construct(DecoratedSearchCriteriaFactory $categorySearchCriteriaFactory)
    {
        $this->categorySearchCriteriaFactory = $categorySearchCriteriaFactory;
    }

    /**
     * @param FilterSearchCriteriaEvent $event
     */
    public function onFilterSearchCriteria(FilterSearchCriteriaEvent $event)
    {
        if (!$event->getSearchCriteria() instanceof CategoryFilters) {
            return;
        }

        $newSearchCriteria = $this->categorySearchCriteriaFactory->createFrom($event->getSearchCriteria());

        $newFilters = new CategoryFilters([
            'orderBy' => $newSearchCriteria->getOrderBy(),
            'sortOrder' => $newSearchCriteria->getOrderWay(),
            'offset' => $newSearchCriteria->getOffset(),
            'limit' => $newSearchCriteria->getLimit(),
            'filters' => $newSearchCriteria->getFilters(),
        ]);

        $event->setSearchCriteria($newFilters);
    }
}
