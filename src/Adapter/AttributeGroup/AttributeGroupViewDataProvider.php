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

namespace PrestaShop\PrestaShop\Adapter\AttributeGroup;

use AttributeGroup;
use PrestaShop\PrestaShop\Core\AttributeGroup\AttributeGroupViewDataProviderInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Exception\AttributeGroupException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Exception\AttributeGroupNotFoundException;
use PrestaShopException;

/**
 * Provides data required for attribute group view action using legacy object models
 */
final class AttributeGroupViewDataProvider implements AttributeGroupViewDataProviderInterface
{
    /**
     * @var int
     */
    private $contextLangId;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param int $contextLangId
     * @param ConfigurationInterface $configuration
     */
    public function __construct($contextLangId, ConfigurationInterface $configuration)
    {
        $this->contextLangId = $contextLangId;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function isColorGroup($attributeGroupId)
    {
        $attributeGroup = $this->getAttributeGroupById($attributeGroupId);

        return (bool) $attributeGroup->is_color_group;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeGroupNameById($attributeGroupId)
    {
        $attributeGroup = $this->getAttributeGroupById($attributeGroupId);

        if (!isset($attributeGroup->name[$this->contextLangId])) {
            return $attributeGroup->name[$this->configuration->get('PS_LANG_DEFAULT')];
        }

        return $attributeGroup->name[$this->contextLangId];
    }

    /**
     * Gets legacy AttributeGroup object by provided id
     *
     * @param int $attributeGroupId
     *
     * @return AttributeGroup
     *
     * @throws AttributeGroupException
     * @throws AttributeGroupNotFoundException
     */
    private function getAttributeGroupById($attributeGroupId)
    {
        try {
            $attributeGroup = new AttributeGroup($attributeGroupId);

            if ($attributeGroup->id !== $attributeGroupId) {
                throw new AttributeGroupNotFoundException(sprintf('Attribute group with id "%s" was not found.', $attributeGroupId));
            }
        } catch (PrestaShopException $e) {
            throw new AttributeGroupException(sprintf('An error occurred when trying to get attribute group with id %s', $attributeGroupId));
        }

        return $attributeGroup;
    }
}
