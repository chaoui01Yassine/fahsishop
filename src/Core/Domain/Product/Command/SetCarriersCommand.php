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

namespace PrestaShop\PrestaShop\Core\Domain\Product\Command;

use PrestaShop\PrestaShop\Core\Domain\Carrier\ValueObject\CarrierReferenceId;
use PrestaShop\PrestaShop\Core\Domain\Product\Exception\ProductConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;

/**
 * Set the list of carriers for a product
 */
class SetCarriersCommand
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var ShopConstraint
     */
    private $shopConstraint;

    /**
     * @var CarrierReferenceId[]|null
     */
    private $carrierReferenceIds;

    /**
     * @param int $productId
     * @param int[] $carrierReferenceIds List of carrier reference IDs (instead of usual primary id as most entities)
     * @param ShopConstraint $shopConstraint
     *
     * @throws ProductConstraintException
     */
    public function __construct(
        int $productId,
        array $carrierReferenceIds,
        ShopConstraint $shopConstraint
    ) {
        $this->productId = new ProductId($productId);
        $this->shopConstraint = $shopConstraint;
        $this->setCarrierReferenceIds($carrierReferenceIds);
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return ShopConstraint
     */
    public function getShopConstraint(): ShopConstraint
    {
        return $this->shopConstraint;
    }

    /**
     * @return CarrierReferenceId[]
     */
    public function getCarrierReferenceIds(): ?array
    {
        return $this->carrierReferenceIds;
    }

    /**
     * @param int[] $carrierReferenceIds
     */
    private function setCarrierReferenceIds(array $carrierReferenceIds): void
    {
        $this->carrierReferenceIds = [];
        foreach (array_unique($carrierReferenceIds) as $carrierReferenceId) {
            $this->carrierReferenceIds[] = new CarrierReferenceId((int) $carrierReferenceId);
        }
    }
}
