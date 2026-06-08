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
declare(strict_types=1);

namespace PrestaShop\Module\DistributionApiClient;

use Context;
use Link;
use RuntimeException;

/**
 * Provides information about the shop, to be added to API calls
 */
class ShopDataProvider
{
    /**
     * Returns the default URL to shop's Front office
     *
     * @return string
     */
    public function getShopUrl(): string
    {
        $context = Context::getContext();
        if (!$context instanceof Context || !$context->link instanceof Link) {
            throw new RuntimeException('Unable to retrieve the contextual Link instance');
        }

        return $context->link->getBaseLink();
    }
}
