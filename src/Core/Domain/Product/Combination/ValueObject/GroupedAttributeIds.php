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

namespace PrestaShop\PrestaShop\Core\Domain\Product\Combination\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Attribute\Exception\AttributeConstraintException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Attribute\ValueObject\AttributeId;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Exception\AttributeGroupConstraintException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\ValueObject\AttributeGroupId;

/**
 * Combines value objects into a valid structure for generating combinations
 */
class GroupedAttributeIds
{
    /**
     * @var AttributeGroupId
     */
    private $attributeGroupId;

    /**
     * @var AttributeId[]
     */
    private $attributeIds = [];

    /**
     * @param int $attributeGroupId
     * @param array $attributeIds
     *
     * @throws AttributeConstraintException
     * @throws AttributeGroupConstraintException
     */
    public function __construct(
        int $attributeGroupId,
        array $attributeIds
    ) {
        $this->attributeGroupId = new AttributeGroupId($attributeGroupId);
        $this->setAttributeIds($attributeIds);
    }

    /**
     * @return AttributeGroupId
     */
    public function getAttributeGroupId(): AttributeGroupId
    {
        return $this->attributeGroupId;
    }

    /**
     * @return AttributeId[]
     */
    public function getAttributeIds(): array
    {
        return $this->attributeIds;
    }

    /**
     * @param int[] $attributeIds
     *
     * @throws AttributeConstraintException
     */
    private function setAttributeIds(array $attributeIds): void
    {
        foreach ($attributeIds as $attributeId) {
            $this->attributeIds[] = new AttributeId($attributeId);
        }
    }
}
