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

namespace PrestaShop\PrestaShop\Core\Domain\Product\Stock\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Product\Stock\Exception\ProductStockConstraintException;

/**
 * Stock identifier.
 */
class StockId
{
    /**
     * @var int
     */
    private $stockId;

    /**
     * @param int $stockId
     *
     * @throws ProductStockConstraintException
     */
    public function __construct(int $stockId)
    {
        $this->assertIsGreaterThanZero($stockId);

        $this->stockId = $stockId;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->stockId;
    }

    /**
     * @param int $stockId
     */
    private function assertIsGreaterThanZero(int $stockId): void
    {
        if (0 > $stockId) {
            throw new ProductStockConstraintException(
                sprintf('Stock id %s is invalid. Stock id must be number that is greater than zero.', var_export($stockId, true)),
                ProductStockConstraintException::INVALID_ID
            );
        }
    }
}
