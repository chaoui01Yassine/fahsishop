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

namespace PrestaShop\PrestaShop\Core\Grid\Definition\Factory\Monitoring;

/**
 * Builds Grid definition for disabled product grid
 */
final class DisabledProductGridDefinitionFactory extends AbstractProductGridDefinitionFactory
{
    public const GRID_ID = 'disabled_product';

    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return $this->trans('List of disabled products', [], 'Admin.Catalog.Feature');
    }

    /**
     * {@inheritdoc}
     */
    protected function getColumns()
    {
        return parent::getColumns()->remove('active');
    }

    protected function getFilters()
    {
        return parent::getFilters()->remove('active');
    }
}
