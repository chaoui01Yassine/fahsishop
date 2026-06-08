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

namespace PrestaShop\PrestaShop\Adapter\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Supplier;

/**
 * Returns the list of selectable suppliers, including those which are disabled.
 */
final class SupplierNameByIdChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getChoices()
    {
        $choices = [];
        $suppliers = Supplier::getSuppliers(false, 0, false);
        $hasDuplicated = $this->hasDuplicateSuppliers($suppliers);

        foreach ($suppliers as $supplier) {
            // Integrate the ID in the name so that suppliers with identical names don't override themselves (only when duplicate are detected)
            $supplierName = $supplier['name'];
            if ($hasDuplicated) {
                $supplierName = sprintf('%d - %s', $supplier['id_supplier'], $supplierName);
            }
            $choices[$supplierName] = (int) $supplier['id_supplier'];
        }

        return $choices;
    }

    private function hasDuplicateSuppliers(array $suppliers): bool
    {
        $names = [];
        foreach ($suppliers as $supplier) {
            if (in_array($supplier['name'], $names)) {
                return true;
            }

            $names[] = $supplier['name'];
        }

        return false;
    }
}
