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

namespace PrestaShop\PrestaShop\Adapter\Address;

use CustomerAddress;
use PrestaShop\PrestaShop\Core\Domain\Address\Exception\AddressException;
use PrestaShopDatabaseException;

abstract class AbstractCustomerAddressHandler extends AbstractAddressHandler
{
    /**
     * @return string[]
     *
     * @throws AddressException
     */
    protected function getRequiredFields(): array
    {
        try {
            $requiredFields = (new CustomerAddress())->getFieldsRequiredDatabase();
        } catch (PrestaShopDatabaseException $e) {
            throw new AddressException('Something went wrong while retrieving required fields for address', 0, $e);
        }

        if (empty($requiredFields)) {
            return [];
        }

        $fields = [];

        foreach ($requiredFields as $field) {
            $fields[] = $field['field_name'];
        }

        return $fields;
    }
}
