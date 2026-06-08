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

namespace PrestaShop\PrestaShop\Adapter\Product\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductRepository;
use PrestaShop\PrestaShop\Adapter\Product\Update\ProductIndexationUpdater;
use PrestaShop\PrestaShop\Core\Domain\Product\Command\UpdateProductStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\Product\CommandHandler\UpdateProductStatusHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Product\Exception\CannotUpdateProductException;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;

/**
 * @deprecated since 8.1 and will be removed in next major version.
 *
 * @internal
 */
class UpdateProductStatusHandler implements UpdateProductStatusHandlerInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductIndexationUpdater
     */
    private $productIndexationUpdater;

    public function __construct(
        ProductRepository $productRepository,
        ProductIndexationUpdater $productIndexationUpdater
    ) {
        $this->productRepository = $productRepository;
        $this->productIndexationUpdater = $productIndexationUpdater;
    }

    /**
     * @param UpdateProductStatusCommand $command
     */
    public function handle(UpdateProductStatusCommand $command)
    {
        $allShopsConstraint = ShopConstraint::allShops();
        $product = $this->productRepository->getByShopConstraint($command->getProductId(), $allShopsConstraint);
        $product->active = $command->getEnable();
        $this->productRepository->partialUpdate(
            $product,
            ['active'],
            $allShopsConstraint,
            CannotUpdateProductException::FAILED_UPDATE_STATUS
        );
        $this->productIndexationUpdater->updateIndexation($product, $allShopsConstraint);
    }
}
