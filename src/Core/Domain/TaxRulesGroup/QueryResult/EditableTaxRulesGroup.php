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

namespace PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\TaxRulesGroup\ValueObject\TaxRulesGroupId;

/**
 * Transfers tax rules group data for editing
 */
class EditableTaxRulesGroup
{
    /**
     * @var TaxRulesGroupId
     */
    protected $taxRulesGroupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var int[]
     */
    protected $shopAssociationIds;

    /**
     * @param TaxRulesGroupId $taxRulesGroupId
     * @param string $name
     * @param bool $active
     * @param array<int> $shopAssociationIds
     */
    public function __construct(
        TaxRulesGroupId $taxRulesGroupId,
        string $name,
        bool $active,
        array $shopAssociationIds
    ) {
        $this->taxRulesGroupId = $taxRulesGroupId;
        $this->name = $name;
        $this->active = $active;
        $this->shopAssociationIds = $shopAssociationIds;
    }

    /**
     * @return TaxRulesGroupId
     */
    public function getTaxRulesGroupId(): TaxRulesGroupId
    {
        return $this->taxRulesGroupId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return int[]
     */
    public function getShopAssociationIds(): array
    {
        return $this->shopAssociationIds;
    }
}
