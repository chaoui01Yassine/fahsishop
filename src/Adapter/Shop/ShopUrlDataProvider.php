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

namespace PrestaShop\PrestaShop\Adapter\Shop;

use PrestaShopException;
use ShopUrl;
use Validate;

/**
 * Class ShopUrlDataProvider is responsible for providing data from shop_url table.
 */
class ShopUrlDataProvider
{
    /**
     * @var int
     */
    private $contextShopId;

    /**
     * ShopUrlDataProvider constructor.
     *
     * @param int $contextShopId
     */
    public function __construct($contextShopId)
    {
        $this->contextShopId = $contextShopId;
    }

    /**
     * Gets main shop url data.
     *
     * @return ShopUrl
     *
     * @throws PrestaShopException
     */
    public function getMainShopUrl()
    {
        /** @var ShopUrl $result */
        $result = ShopUrl::getShopUrls($this->contextShopId)->where('main', '=', 1)->getFirst();

        if (!Validate::isLoadedObject($result)) {
            return new ShopUrl();
        }

        return $result;
    }

    /**
     * Checks whenever the main shop url exists for current shop context.
     *
     * @return bool
     *
     * @throws PrestaShopException
     */
    public function doesMainShopUrlExist()
    {
        $shopUrl = ShopUrl::getShopUrls($this->contextShopId)->where('main', '=', 1)->getFirst();

        return Validate::isLoadedObject($shopUrl);
    }
}
