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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\CommandBuilder\Product\Combination;

use PrestaShop\PrestaShop\Core\Domain\Product\Combination\ValueObject\CombinationId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;

class CombinationCommandsBuilder implements CombinationCommandsBuilderInterface
{
    /**
     * @var iterable<CombinationCommandsBuilderInterface>
     */
    private $commandBuilders;

    /**
     * @param iterable<CombinationCommandsBuilderInterface> $commandBuilders
     */
    public function __construct(iterable $commandBuilders)
    {
        $this->commandBuilders = $commandBuilders;
    }

    /**
     * {@inheritDoc}
     */
    public function buildCommands(CombinationId $combinationId, array $formData, ShopConstraint $singleShopConstraint): array
    {
        $commandCollection = [];
        foreach ($this->commandBuilders as $commandBuilder) {
            $commands = $commandBuilder->buildCommands($combinationId, $formData, $singleShopConstraint);

            if (!empty($commands)) {
                $commandCollection = array_merge($commandCollection, $commands);
            }
        }

        return $commandCollection;
    }
}
