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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\Query\GetProductImages;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\QueryResult\ProductImage;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;

final class ProductImagesChoiceProvider implements ConfigurableFormChoiceProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    private $queryBus;

    /**
     * @var int
     */
    private $defaultShopId;

    /**
     * @var int|null
     */
    private $contextShopId;

    /**
     * @param CommandBusInterface $queryBus
     */
    public function __construct(
        CommandBusInterface $queryBus,
        int $defaultShopId,
        ?int $contextShopId
    ) {
        $this->queryBus = $queryBus;
        $this->defaultShopId = $defaultShopId;
        $this->contextShopId = $contextShopId;
    }

    /**
     * {@inheritDoc}
     */
    public function getChoices(array $options): array
    {
        if (empty($options['product_id'])) {
            return [];
        }

        $shopConstraint = null !== $this->contextShopId ? ShopConstraint::shop($this->contextShopId) : ShopConstraint::shop($this->defaultShopId);
        /** @var ProductImage[] $productImages */
        $productImages = $this->queryBus->handle(new GetProductImages((int) $options['product_id'], $shopConstraint));

        $choices = [];
        foreach ($productImages as $productImage) {
            $choices[$productImage->getThumbnailUrl()] = $productImage->getImageId();
        }

        return $choices;
    }
}
