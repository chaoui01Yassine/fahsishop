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

namespace PrestaShop\PrestaShop\Adapter;

use Address;

/**
 * Class responsible for creating Address ObjectModel.
 */
class AddressFactory
{
    /**
     * Initialize an address corresponding to the specified id address or if empty to the
     * default shop configuration.
     *
     * @param int|null $id_address
     * @param bool $with_geoloc
     *
     * @return Address
     */
    public function findOrCreate($id_address = null, $with_geoloc = false)
    {
        $func_args = func_get_args();

        return call_user_func_array(['\\Address', 'initialize'], $func_args);
    }

    /**
     * Check if an address exists depending on given $id_address.
     *
     * @param int $id_address
     * @param bool $useCache [default=false] If true, use Cache for optimizing queries
     *
     * @return bool
     */
    public function addressExists($id_address, bool $useCache = false)
    {
        return Address::addressExists($id_address, $useCache);
    }
}
