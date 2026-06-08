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

namespace PrestaShop\PrestaShop\Core\Grid\Data\Factory;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Grid\Data\GridData;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Image\ImageProviderInterface;

/**
 * Gets data for carrier grid
 */
class CarrierGridDataFactory implements GridDataFactoryInterface
{
    /**
     * @var GridDataFactoryInterface
     */
    private $carrierDataFactory;

    /**
     * @var ImageProviderInterface
     */
    private $carrierLogoProvider;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param GridDataFactoryInterface $carrierDataFactory
     * @param ImageProviderInterface $carrierLogoProvider
     * @param ConfigurationInterface $configuration
     */
    public function __construct(
        GridDataFactoryInterface $carrierDataFactory,
        ImageProviderInterface $carrierLogoProvider,
        ConfigurationInterface $configuration
    ) {
        $this->carrierDataFactory = $carrierDataFactory;
        $this->carrierLogoProvider = $carrierLogoProvider;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(SearchCriteriaInterface $searchCriteria)
    {
        $carrierData = $this->carrierDataFactory->getData($searchCriteria);
        $modifiedRecords = $this->applyModifications($carrierData->getRecords()->all());

        return new GridData(
            new RecordCollection($modifiedRecords),
            $carrierData->getRecordsTotal(),
            $carrierData->getQuery()
        );
    }

    /**
     * Add logo column to grid.
     *
     * @param array $carriers
     *
     * @return array
     */
    private function applyModifications(array $carriers): array
    {
        $carrierDefaultName = str_replace(
            ['#', ';'],
            '',
            $this->configuration->get('PS_SHOP_NAME')
        );

        foreach ($carriers as $i => $carrier) {
            $carriers[$i]['logo'] = $this->carrierLogoProvider->getPath($carrier['id_carrier']);

            if ($carrier['name'] === '0') {
                $carriers[$i]['name'] = $carrierDefaultName;
            }
        }

        return $carriers;
    }
}
