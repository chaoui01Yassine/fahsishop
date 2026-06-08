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

namespace PrestaShop\PrestaShop\Core\Domain\SqlManagement\Exception;

/**
 * Is thrown when SqlManagement constraints are violated
 */
class SqlManagementConstraintException extends SqlManagementException
{
    /**
     * When database table name is invalid
     */
    public const INVALID_DATABASE_TABLE_NAME = 10;

    /**
     * When database table field is invalid
     */
    public const INVALID_DATABASE_TABLE_FIELD = 20;

    /**
     * When database table field name is invalid
     */
    public const INVALID_DATABASE_TABLE_FIELD_NAME = 30;

    /**
     * When database table field type is invalid
     */
    public const INVALID_DATABASE_TABLE_FIELD_TYPE = 40;
}
