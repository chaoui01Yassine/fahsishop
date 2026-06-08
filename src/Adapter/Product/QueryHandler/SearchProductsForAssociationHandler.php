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

namespace PrestaShop\PrestaShop\Adapter\Product\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Product\Image\ProductImagePathFactory;
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductRepository;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\ValueObject\ImageId;
use PrestaShop\PrestaShop\Core\Domain\Product\Query\SearchProductsForAssociation;
use PrestaShop\PrestaShop\Core\Domain\Product\QueryHandler\SearchProductsForAssociationHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Product\QueryResult\ProductForAssociation;

class SearchProductsForAssociationHandler implements SearchProductsForAssociationHandlerInterface
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProductImagePathFactory
     */
    private $productImagePathFactory;

    /**
     * @param ProductRepository $productRepository
     * @param ProductImagePathFactory $productImagePathFactory
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductImagePathFactory $productImagePathFactory
    ) {
        $this->productRepository = $productRepository;
        $this->productImagePathFactory = $productImagePathFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(SearchProductsForAssociation $query): array
    {
        $foundProducts = $this->productRepository->searchProducts(
            $query->getPhrase(),
            $query->getLanguageId(),
            $query->getShopId(),
            $query->getLimit()
        );

        $productsForAssociation = [];
        foreach ($foundProducts as $foundProduct) {
            $productsForAssociation[] = $this->createResult($foundProduct);
        }

        return $productsForAssociation;
    }

    /**
     * @param array $foundProduct
     *
     * @return ProductForAssociation
     */
    private function createResult(array $foundProduct): ProductForAssociation
    {
        if (empty($foundProduct['id_image'])) {
            $imagePath = $this->productImagePathFactory->getNoImagePath(ProductImagePathFactory::IMAGE_TYPE_HOME_DEFAULT);
        } else {
            $imagePath = $this->productImagePathFactory->getPathByType(
                new ImageId((int) $foundProduct['id_image']),
                ProductImagePathFactory::IMAGE_TYPE_HOME_DEFAULT
            );
        }

        return new ProductForAssociation(
            (int) $foundProduct['id_product'],
            $foundProduct['name'],
            $foundProduct['reference'] ?? '',
            $imagePath
        );
    }
}
