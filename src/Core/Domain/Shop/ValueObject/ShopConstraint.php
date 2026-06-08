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

namespace PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Shop\Exception\ShopException;

class ShopConstraint
{
    /**
     * @var ShopId|null
     */
    protected $shopId;

    /**
     * @var ShopGroupId|null
     */
    protected $shopGroupId;

    /**
     * Indicate if the value returned matches the constraints strictly, else it fallbacks to Shop > Group > Global value
     *
     * @var bool
     */
    protected $strict;

    /**
     * Constraint to get configuration for a specific shop
     *
     * @param int $shopId
     * @param bool $isStrict
     *
     * @return static
     *
     * @throws ShopException
     */
    public static function shop(int $shopId, bool $isStrict = false): self
    {
        return new static($shopId, null, $isStrict);
    }

    /**
     * Constraint to get configuration for a specific shop group
     *
     * @param int $shopGroupId
     * @param bool $isStrict
     *
     * @return static
     *
     * @throws ShopException
     */
    public static function shopGroup(int $shopGroupId, bool $isStrict = false): self
    {
        return new static(null, $shopGroupId, $isStrict);
    }

    /**
     * Constraint to get configuration for all shops (the global value)
     *
     * @param bool $isStrict
     *
     * @return static
     */
    public static function allShops(bool $isStrict = false): self
    {
        return new static(null, null, $isStrict);
    }

    /**
     * @param int|null $shopId
     * @param int|null $shopGroupId
     * @param bool $strict
     *
     * @throws ShopException
     */
    protected function __construct(?int $shopId, ?int $shopGroupId, bool $strict = false)
    {
        $this->shopId = null !== $shopId ? new ShopId($shopId) : null;
        $this->shopGroupId = null !== $shopGroupId ? new ShopGroupId($shopGroupId) : null;
        $this->strict = $strict;
    }

    /**
     * @return ShopId|null
     */
    public function getShopId(): ?ShopId
    {
        return $this->shopId;
    }

    /**
     * @return ShopGroupId|null
     */
    public function getShopGroupId(): ?ShopGroupId
    {
        return $this->shopGroupId;
    }

    /**
     * @return bool
     */
    public function forAllShops(): bool
    {
        return null === $this->shopId && null === $this->shopGroupId;
    }

    /**
     * @return bool
     */
    public function isStrict(): bool
    {
        return $this->strict;
    }
}
