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

namespace PrestaShop\Module\LinkList\Filter;

class LinkFilter
{
    /**
     * @var RouteFilterInterface[]
     */
    private $routeFilters = [];

    public function __construct(array $routeFilters = [])
    {
        $this->addRouteFilter(...$routeFilters);
    }

    public function addRouteFilter(RouteFilterInterface ...$routeFilters): void
    {
        foreach ($routeFilters as $routeFilter) {
            $this->routeFilters[] = $routeFilter;
        }
    }

    public function isRouteEnabled(string $routeId): bool
    {
        foreach ($this->routeFilters as $filter) {
            if ($filter->supports($routeId) && !$filter->isRouteEnabled($routeId)) {
                return false;
            }
        }

        return true;
    }
}
