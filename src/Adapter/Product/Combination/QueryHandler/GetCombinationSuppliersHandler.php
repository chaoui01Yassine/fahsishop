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

namespace PrestaShop\PrestaShop\Adapter\Product\Combination\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Product\AbstractProductSupplierHandler;
use PrestaShop\PrestaShop\Adapter\Product\Combination\Repository\CombinationRepository;
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductSupplierRepository;
use PrestaShop\PrestaShop\Core\Domain\Product\Combination\Query\GetCombinationSuppliers;
use PrestaShop\PrestaShop\Core\Domain\Product\Combination\QueryHandler\GetCombinationSuppliersHandlerInterface;

class GetCombinationSuppliersHandler extends AbstractProductSupplierHandler implements GetCombinationSuppliersHandlerInterface
{
    /**
     * @var CombinationRepository
     */
    private $combinationRepository;

    /**
     * @param ProductSupplierRepository $productSupplierRepository
     * @param CombinationRepository $combinationRepository
     */
    public function __construct(
        ProductSupplierRepository $productSupplierRepository,
        CombinationRepository $combinationRepository
    ) {
        parent::__construct($productSupplierRepository);
        $this->combinationRepository = $combinationRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(GetCombinationSuppliers $query): array
    {
        $combinationId = $query->getCombinationId();

        return $this->getProductSuppliersInfo(
            $this->combinationRepository->getProductId($combinationId),
            $combinationId
        );
    }
}
