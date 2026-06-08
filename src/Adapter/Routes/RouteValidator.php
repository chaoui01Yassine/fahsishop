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

namespace PrestaShop\PrestaShop\Adapter\Routes;

use Dispatcher;
use PrestaShopException;
use Validate;

/**
 * Class RouteValidator is responsible for validating routes.
 */
class RouteValidator
{
    /**
     * Check for a route pattern validity.
     *
     * @param string $pattern to validate
     *
     * @return bool Validity is ok or not
     */
    public function isRoutePattern($pattern)
    {
        return Validate::isRoutePattern($pattern);
    }

    /**
     * Check if a route rule contain all required keywords of default route definition.
     *
     * @param string $routeId
     * @param string $rule Rule to verify
     *
     * @return array - returns list of missing keywords
     *
     * @throws PrestaShopException
     */
    public function doesRouteContainsRequiredKeywords($routeId, $rule)
    {
        $missingKeywords = [];
        $validationResult = Dispatcher::getInstance()->validateRoute($routeId, $rule, $missingKeywords);

        return $validationResult ? [] : $missingKeywords;
    }
}
