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

namespace PrestaShop\PrestaShop\Core\Grid\Filter;

/**
 * Class Filter defines single filter for grid.
 */
final class Filter implements FilterInterface
{
    /**
     * @var string Fully qualified filter type class name
     */
    private $type;

    /**
     * @var array Filter type options
     */
    private $typeOptions = [];

    /**
     * @var string Filter name
     */
    private $name;

    /**
     * @var string|null Column ID if filter is associated with columns
     */
    private $column;

    /**
     * @param string $name
     * @param string $filterFormType
     */
    public function __construct($name, $filterFormType)
    {
        $this->type = $filterFormType;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setTypeOptions(array $filterTypeOptions)
    {
        $this->typeOptions = $filterTypeOptions;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeOptions()
    {
        return $this->typeOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setAssociatedColumn($columnId)
    {
        $this->column = $columnId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedColumn()
    {
        return $this->column;
    }
}
