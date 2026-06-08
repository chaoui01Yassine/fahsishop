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

use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\CategoryId;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use RuntimeException;

/**
 * Sets new product-category associations
 */
class SetAssociatedProductCategoriesCommand
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var CategoryId
     */
    private $defaultCategoryId;

    /**
     * @var CategoryId[]
     */
    private $categoryIds;

    /**
     * @var ShopConstraint
     */
    private $shopConstraint;

    /**
     * @param int $productId
     * @param int $defaultCategoryId
     * @param int[] $categoryIds
     */
    public function __construct(
        int $productId,
        int $defaultCategoryId,
        array $categoryIds,
        ShopConstraint $shopConstraint
    ) {
        $this->setCategoryIds($categoryIds);
        $this->defaultCategoryId = new CategoryId($defaultCategoryId);
        $this->productId = new ProductId($productId);
        $this->shopConstraint = $shopConstraint;
    }

    /**
     * @return CategoryId
     */
    public function getDefaultCategoryId(): CategoryId
    {
        return $this->defaultCategoryId;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return CategoryId[]
     */
    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    /**
     * @return ShopConstraint
     */
    public function getShopConstraint(): ShopConstraint
    {
        return $this->shopConstraint;
    }

    /**
     * @param int[] $categoryIds
     */
    private function setCategoryIds(array $categoryIds): void
    {
        $this->assertCategoryIdsAreNotEmpty($categoryIds);

        $this->categoryIds = array_map(
            function ($id) {
                return new CategoryId($id);
            }, $categoryIds
        );
    }

    /**
     * @param int[] $categoryIds
     */
    private function assertCategoryIdsAreNotEmpty(array $categoryIds): void
    {
        if (empty($categoryIds)) {
            throw new RuntimeException(sprintf(
                'Empty categoryIds provided in %s. To remove categories use %s.',
                self::class,
                RemoveAllAssociatedProductCategoriesCommand::class
            ));
        }
    }
}
