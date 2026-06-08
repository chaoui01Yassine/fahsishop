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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider;

use PrestaShop\PrestaShop\Adapter\Group\GroupDataProvider;
use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Category\Query\GetCategoryForEditing;
use PrestaShop\PrestaShop\Core\Domain\Category\QueryResult\EditableCategory;

/**
 * Provides data for category add/edit category forms
 */
final class CategoryFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    private $queryBus;

    /**
     * @var int
     */
    private $contextShopId;

    /**
     * @var int
     */
    private $contextShopRootCategoryId;

    /**
     * @var GroupDataProvider
     */
    private $groupDataProvider;

    /**
     * @param CommandBusInterface $queryBus
     * @param int $contextShopId
     * @param int $contextShopRootCategoryId
     * @param GroupDataProvider $groupDataProvider
     */
    public function __construct(
        CommandBusInterface $queryBus,
        $contextShopId,
        $contextShopRootCategoryId,
        GroupDataProvider $groupDataProvider
    ) {
        $this->queryBus = $queryBus;
        $this->contextShopId = $contextShopId;
        $this->contextShopRootCategoryId = $contextShopRootCategoryId;
        $this->groupDataProvider = $groupDataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($categoryId)
    {
        /** @var EditableCategory $editableCategory */
        $editableCategory = $this->queryBus->handle(new GetCategoryForEditing($categoryId));

        return [
            'name' => $editableCategory->getName(),
            'active' => $editableCategory->isActive(),
            'id_parent' => $editableCategory->getParentId(),
            'description' => $editableCategory->getDescription(),
            'additional_description' => $editableCategory->getAdditionalDescription(),
            'meta_title' => $editableCategory->getMetaTitle(),
            'meta_description' => $editableCategory->getMetaDescription(),
            'meta_keyword' => $editableCategory->getMetaKeywords(),
            'link_rewrite' => $editableCategory->getLinkRewrite(),
            'group_association' => $editableCategory->getGroupAssociationIds(),
            'shop_association' => $editableCategory->getShopAssociationIds(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        $allGroupIds = $this->groupDataProvider->getAllGroupIds();

        return [
            'id_parent' => $this->contextShopRootCategoryId,
            'group_association' => $allGroupIds,
            'shop_association' => $this->contextShopId,
            'active' => true,
        ];
    }
}
