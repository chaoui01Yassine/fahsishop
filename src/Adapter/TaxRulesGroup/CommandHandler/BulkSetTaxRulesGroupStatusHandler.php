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

namespace PrestaShop\PrestaShop\Adapter\TaxRulesGroup\CommandHandler;

use PrestaShop\PrestaShop\Adapter\TaxRulesGroup\AbstractTaxRulesGroupHandler;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Command\BulkSetTaxRulesGroupStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\CommandHandler\BulkToggleTaxRulesGroupStatusHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Exception\CannotBulkUpdateTaxRulesGroupException;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Exception\TaxRulesGroupException;

/**
 * Handles toggling of multiple tax rules groups statuses
 */
final class BulkSetTaxRulesGroupStatusHandler extends AbstractTaxRulesGroupHandler implements BulkToggleTaxRulesGroupStatusHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws CannotBulkUpdateTaxRulesGroupException
     */
    public function handle(BulkSetTaxRulesGroupStatusCommand $command): void
    {
        $errors = [];

        foreach ($command->getTaxRulesGroupIds() as $taxRuleGroupId) {
            try {
                $taxRuleGroup = $this->getTaxRulesGroup($taxRuleGroupId);

                if (!$this->setTaxRulesGroupStatus($taxRuleGroup, $command->getExpectedStatus())) {
                    $errors[] = $taxRuleGroup->id;
                }
            } catch (TaxRulesGroupException $e) {
                $errors[] = $taxRuleGroupId->getValue();
            }
        }

        if (!empty($errors)) {
            throw new CannotBulkUpdateTaxRulesGroupException($errors, 'Failed to set all tax rules groups statuses without errors');
        }
    }
}
