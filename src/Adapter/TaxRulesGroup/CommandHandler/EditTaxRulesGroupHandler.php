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

namespace PrestaShop\PrestaShop\Adapter\TaxRulesGroup\CommandHandler;

use PrestaShop\PrestaShop\Adapter\TaxRulesGroup\AbstractTaxRulesGroupHandler;
use PrestaShop\PrestaShop\Adapter\TaxRulesGroup\Repository\TaxRulesGroupRepository;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopId;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Command\EditTaxRulesGroupCommand;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\CommandHandler\EditTaxRulesGroupHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Exception\CannotUpdateTaxRulesGroupException;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Exception\TaxRulesGroupException;

/**
 * Handles tax rules group edition
 */
class EditTaxRulesGroupHandler extends AbstractTaxRulesGroupHandler implements EditTaxRulesGroupHandlerInterface
{
    /**
     * @var TaxRulesGroupRepository
     */
    protected $taxRulesGroupRepository;

    /**
     * @param TaxRulesGroupRepository $taxRulesGroupRepository
     */
    public function __construct(TaxRulesGroupRepository $taxRulesGroupRepository)
    {
        $this->taxRulesGroupRepository = $taxRulesGroupRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @throws CannotUpdateTaxRulesGroupException
     * @throws TaxRulesGroupException
     */
    public function handle(EditTaxRulesGroupCommand $command): void
    {
        $taxRulesGroup = $this->getTaxRulesGroup($command->getTaxRulesGroupId());

        $updatableProperties = [];
        if (null !== $command->getName()) {
            $taxRulesGroup->name = $command->getName();
            $updatableProperties[] = 'name';
        }
        if (null !== $command->isEnabled()) {
            $taxRulesGroup->active = $command->isEnabled();
            $updatableProperties[] = 'active';
        }

        $shopIds = [];
        foreach ($command->getShopAssociation() ?? [] as $shopId) {
            $shopIds[] = new ShopId($shopId);
        }

        $this->taxRulesGroupRepository->partialUpdate(
            $taxRulesGroup,
            $updatableProperties,
            $shopIds,
            CannotUpdateTaxRulesGroupException::FAILED_UPDATE_TAX_RULES_GROUP
        );
    }
}
