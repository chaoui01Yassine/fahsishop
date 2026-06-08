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

namespace PrestaShop\PrestaShop\Core\Domain\Product\Command;

use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;

/**
 * Class UpdateProductStatusCommand update a given product status
 *
 * @deprecated since 8.1 and will be removed in next major version.
 */
class UpdateProductStatusCommand
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var bool
     */
    private $enable;

    /**
     * UpdateProductStatusCommand constructor.
     *
     * @param int $productId
     * @param bool $enable
     */
    public function __construct(int $productId, bool $enable)
    {
        @trigger_error(sprintf(
            'Using %s command has been deprecated in 8.1 you should use %s instead.',
            self::class,
            UpdateProductCommand::class
        ), E_USER_DEPRECATED);
        $this->productId = new ProductId($productId);
        $this->enable = $enable;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return bool
     */
    public function getEnable(): bool
    {
        return $this->enable;
    }
}
