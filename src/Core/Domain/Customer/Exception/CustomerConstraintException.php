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

namespace PrestaShop\PrestaShop\Core\Domain\Customer\Exception;

/**
 * Is thrown when customer constraint is violated
 */
class CustomerConstraintException extends CustomerException
{
    /**
     * @var int Code is used when invalid email is provided for customer
     */
    public const INVALID_EMAIL = 1;

    /**
     * @var int Code is used when invalid first name is provided for customer
     */
    public const INVALID_FIRST_NAME = 2;

    /**
     * @var int Code is used when invalid last name is provided for customer
     */
    public const INVALID_LAST_NAME = 3;

    /**
     * @var int Code is used when invalid password is provided for customer
     */
    public const INVALID_PASSWORD = 4;

    /**
     * @var int Code is used when invalid APE code is provided
     */
    public const INVALID_APE_CODE = 5;

    /**
     * @var int Is used when invalid (not string) private note is provided as private note
     */
    public const INVALID_PRIVATE_NOTE = 6;

    /**
     * @var int Code is used when invalid customer birthday is provided
     */
    public const INVALID_BIRTHDAY = 7;

    /**
     * When customer id value is invalid
     */
    public const INVALID_ID = 8;
}
