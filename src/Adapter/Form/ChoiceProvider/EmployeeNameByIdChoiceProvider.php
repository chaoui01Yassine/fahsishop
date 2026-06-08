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

namespace PrestaShop\PrestaShop\Adapter\Form\ChoiceProvider;

use Employee;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * @internal
 */
final class EmployeeNameByIdChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $employees = Employee::getEmployees();

        $choices = [];

        foreach ($employees as $employee) {
            $name = sprintf('%s. %s', substr($employee['firstname'], 0, 1), $employee['lastname']);

            $choices[$name] = (int) $employee['id_employee'];
        }

        return $choices;
    }
}
