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

namespace PrestaShop\PrestaShop\Adapter\Product\FeatureValue\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Feature\Repository\FeatureValueRepository;
use PrestaShop\PrestaShop\Core\Domain\Product\FeatureValue\Query\GetProductFeatureValues;
use PrestaShop\PrestaShop\Core\Domain\Product\FeatureValue\QueryHandler\GetProductFeatureValuesHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Product\FeatureValue\QueryResult\ProductFeatureValue;

/**
 * Defines contract to handle @var GetProductFeatureValues query
 */
class GetProductFeatureValuesHandler implements GetProductFeatureValuesHandlerInterface
{
    /**
     * @var FeatureValueRepository
     */
    private $featureValueRepository;

    public function __construct(FeatureValueRepository $featureValueRepository)
    {
        $this->featureValueRepository = $featureValueRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(GetProductFeatureValues $query): array
    {
        $featureValuesData = $this->featureValueRepository->getAllProductFeatureValues($query->getProductId());
        $productFeatureValues = [];
        foreach ($featureValuesData as $featureValuesDatum) {
            $productFeatureValues[] = new ProductFeatureValue(
                (int) $featureValuesDatum['id_feature'],
                (int) $featureValuesDatum['id_feature_value'],
                $featureValuesDatum['localized_values'],
                1 === (int) $featureValuesDatum['custom']
            );
        }

        return $productFeatureValues;
    }
}
