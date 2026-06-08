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

namespace PrestaShop\PrestaShop\Core\Grid\Data\Factory;

use PrestaShop\PrestaShop\Core\Grid\Data\GridData;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Image\ImageProviderInterface;

/**
 * Class SupplierGridDataFactory gets data for supplier grid.
 */
final class SupplierGridDataFactory implements GridDataFactoryInterface
{
    /**
     * @var GridDataFactoryInterface
     */
    private $supplierDataFactory;

    /**
     * @var ImageProviderInterface
     */
    private $supplierLogoImageProvider;

    /**
     * @param GridDataFactoryInterface $supplierDataFactory
     * @param ImageProviderInterface $supplierLogoImageProvider
     */
    public function __construct(
        GridDataFactoryInterface $supplierDataFactory,
        ImageProviderInterface $supplierLogoImageProvider
    ) {
        $this->supplierDataFactory = $supplierDataFactory;
        $this->supplierLogoImageProvider = $supplierLogoImageProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(SearchCriteriaInterface $searchCriteria)
    {
        $supplierData = $this->supplierDataFactory->getData($searchCriteria);

        $modifiedRecords = $this->applyModification(
            $supplierData->getRecords()->all()
        );

        return new GridData(
            new RecordCollection($modifiedRecords),
            $supplierData->getRecordsTotal(),
            $supplierData->getQuery()
        );
    }

    /**
     * @param array $suppliers
     *
     * @return array
     */
    private function applyModification(array $suppliers)
    {
        foreach ($suppliers as $i => $supplier) {
            $suppliers[$i]['logo'] = $this->supplierLogoImageProvider->getPath($supplier['id_supplier']);
        }

        return $suppliers;
    }
}
