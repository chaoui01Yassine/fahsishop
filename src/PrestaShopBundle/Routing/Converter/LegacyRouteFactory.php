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

namespace PrestaShopBundle\Routing\Converter;

use PrestaShopBundle\Entity\Repository\FeatureFlagRepository;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class LegacyRouteFactory
{
    /**
     * @var FeatureFlagRepository
     */
    private $featureFlagRepository;

    public function __construct(FeatureFlagRepository $featureFlagRepository)
    {
        $this->featureFlagRepository = $featureFlagRepository;
    }

    public function buildFromCollection(RouteCollection $routeCollection): array
    {
        $legacyRoutes = [];

        foreach ($routeCollection as $routeName => $route) {
            if ($this->isLegacyRoute($route)) {
                $legacyRoutes[$routeName] = LegacyRoute::buildLegacyRoute($routeName, $route->getDefaults());
            }
        }

        return $legacyRoutes;
    }

    private function isLegacyRoute(Route $route): bool
    {
        $routeDefaults = $route->getDefaults();

        if (isset($routeDefaults[RouterProvider::LEGACY_LINK_ROUTE_ATTRIBUTE])) {
            if (isset($routeDefaults[RouterProvider::FEATURE_FLAG_NAME])) {
                return $this->featureFlagRepository->isEnabled($routeDefaults[RouterProvider::FEATURE_FLAG_NAME]);
            }

            return true;
        }

        return false;
    }
}
