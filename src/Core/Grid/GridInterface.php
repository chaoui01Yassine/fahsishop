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

namespace PrestaShop\PrestaShop\Core\Grid;

use PrestaShop\PrestaShop\Core\Grid\Data\GridDataInterface;
use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinitionInterface;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Interface GridInterface defines contract for grid.
 */
interface GridInterface
{
    /**
     * Get grid definition.
     *
     * @return GridDefinitionInterface
     */
    public function getDefinition();

    /**
     * Get grid data.
     *
     * @return GridDataInterface
     */
    public function getData();

    /**
     * Get grid data search criteria.
     *
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria();

    /**
     * Get grid filter form.
     *
     * @return FormInterface
     */
    public function getFilterForm();
}
