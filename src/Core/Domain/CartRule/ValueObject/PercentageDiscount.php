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

namespace PrestaShop\PrestaShop\Core\Domain\CartRule\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\CartRule\Exception\CartRuleConstraintException;

/**
 * Percentage discount
 */
class PercentageDiscount
{
    /**
     * @var float
     */
    private $percentage;

    /**
     * @var bool
     */
    private $appliesToDiscountedProducts;

    /**
     * @param float $percentage
     * @param bool $appliesToDiscountedProducts
     */
    public function __construct(float $percentage, bool $appliesToDiscountedProducts)
    {
        if ($percentage <= 0 || $percentage > 100) {
            throw new CartRuleConstraintException('Percentage must be greater than 0 and not greater than 100', CartRuleConstraintException::INVALID_PERCENTAGE);
        }

        $this->percentage = $percentage;
        $this->appliesToDiscountedProducts = $appliesToDiscountedProducts;
    }

    /**
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * @return bool
     */
    public function appliesToDiscountedProducts(): bool
    {
        return $this->appliesToDiscountedProducts;
    }
}
