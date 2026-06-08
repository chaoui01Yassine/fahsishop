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

namespace PrestaShop\PrestaShop\Core\Action;

class ActionsBarButton implements ActionsBarButtonInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string[]
     */
    protected $properties;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $class
     * @param string[] $properties
     * @param string $content
     */
    public function __construct(string $class = '', array $properties = [], string $content = '')
    {
        $this->class = $class;
        $this->properties = $properties;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
