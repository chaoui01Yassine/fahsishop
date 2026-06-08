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
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\Query\GetTaxRulesGroupForEditing;
use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\QueryResult\EditableTaxRulesGroup;

/**
 * Provides data for search engine add/edit form.
 */
class TaxRulesGroupFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    protected $queryBus;

    /**
     * @param CommandBusInterface $queryBus
     */
    public function __construct(CommandBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($id): array
    {
        /** @var EditableTaxRulesGroup $editableTaxRulesGroup */
        $editableTaxRulesGroup = $this->queryBus->handle(new GetTaxRulesGroupForEditing($id));

        return [
            'name' => $editableTaxRulesGroup->getName(),
            'is_enabled' => $editableTaxRulesGroup->isActive(),
            'shop_association' => $editableTaxRulesGroup->getShopAssociationIds(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData(): array
    {
        return [];
    }
}
