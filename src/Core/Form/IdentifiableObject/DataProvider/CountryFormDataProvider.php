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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;

/**
 * Provides data for zone add/edit form.
 */
class CountryFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    protected $queryBus;

    /**
     * @var bool
     */
    protected $multistoreEnabled;

    /**
     * @var int[]
     */
    protected $defaultShopAssociation;

    /**
     * @param CommandBusInterface $queryBus
     * @param bool $multistoreEnabled
     * @param array $defaultShopAssociation
     */
    public function __construct(
        CommandBusInterface $queryBus,
        bool $multistoreEnabled,
        array $defaultShopAssociation
    ) {
        $this->queryBus = $queryBus;
        $this->multistoreEnabled = $multistoreEnabled;
        $this->defaultShopAssociation = $defaultShopAssociation;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($id): void
    {
        //todo: will be implemented on edit PR
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData(): array
    {
        $data = [
            'need_zip_code' => false,
            'is_enabled' => true,
            'contains_states' => false,
            'need_identification_number' => false,
            'display_tax_label' => true,
        ];

        if ($this->multistoreEnabled) {
            $data['shop_association'] = $this->defaultShopAssociation;
        }

        return $data;
    }
}
