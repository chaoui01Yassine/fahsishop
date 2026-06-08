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

namespace PrestaShop\PrestaShop\Core\Grid\Action;

use PrestaShop\PrestaShop\Core\Grid\Collection\AbstractCollection;

/**
 * Class PanelActionCollection is responsible for holding single grid actions.
 *
 * @property GridActionInterface[] $items
 */
final class GridActionCollection extends AbstractCollection implements GridActionCollectionInterface
{
    /**
     * {@inheritdoc}
     */
    public function add(GridActionInterface $action)
    {
        $this->items[$action->getId()] = $action;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $actionsArray = [];

        foreach ($this->items as $action) {
            $actionsArray[] = [
                'id' => $action->getId(),
                'name' => $action->getName(),
                'icon' => $action->getIcon(),
                'type' => $action->getType(),
                'options' => $action->getOptions(),
            ];
        }

        return $actionsArray;
    }
}
