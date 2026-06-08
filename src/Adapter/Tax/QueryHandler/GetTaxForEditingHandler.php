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

namespace PrestaShop\PrestaShop\Adapter\Tax\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Tax\AbstractTaxHandler;
use PrestaShop\PrestaShop\Core\Domain\Tax\Query\GetTaxForEditing;
use PrestaShop\PrestaShop\Core\Domain\Tax\QueryHandler\GetTaxForEditingHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Tax\QueryResult\EditableTax;

/**
 * Handles query which gets tax for editing
 */
final class GetTaxForEditingHandler extends AbstractTaxHandler implements GetTaxForEditingHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(GetTaxForEditing $query)
    {
        $tax = $this->getTax($query->getTaxId());

        return new EditableTax(
            $query->getTaxId(),
            $tax->name,
            (float) $tax->rate,
            (bool) $tax->active
        );
    }
}
