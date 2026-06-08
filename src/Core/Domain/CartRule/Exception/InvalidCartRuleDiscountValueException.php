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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\CartRule\Exception;

/**
 * Thrown when a discount is added with an invalid amount/percentage
 */
class InvalidCartRuleDiscountValueException extends InvalidCartRuleValueException
{
    /**
     * Code used when an invalid percent value is under min value
     */
    public const INVALID_MIN_PERCENT = 10;

    /**
     * Code used when an invalid percent value is above max value
     */
    public const INVALID_MAX_PERCENT = 20;

    /**
     * Code used when the specified amount is under min value
     */
    public const INVALID_MIN_AMOUNT = 30;

    /**
     * Code used when the specified amount is above max value
     */
    public const INVALID_MAX_AMOUNT = 40;

    /**
     * Code used when free shipping cannot be applied
     */
    public const INVALID_FREE_SHIPPING = 50;
}
