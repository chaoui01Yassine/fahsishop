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

namespace PrestaShop\PrestaShop\Adapter\Product\Combination\Update\Filler;

use Combination;
use PrestaShop\PrestaShop\Core\Domain\Product\Combination\Command\UpdateCombinationCommand;

/**
 * This class wraps up all the product property fillers and merges the updatable properties into a single array.
 * It is intentional that this class doesn't have the same tag as all the internal property fillers.
 *
 * All the internal property fillers are split just to contain less code and be more readable (because the Product contains many of properties).
 */
class CombinationFiller implements CombinationFillerInterface
{
    /**
     * @var CombinationFillerInterface[]
     */
    private $updatablePropertyFillers;

    /**
     * @param CombinationFillerInterface[] $updatablePropertyFillers
     */
    public function __construct(
        iterable $updatablePropertyFillers
    ) {
        $this->updatablePropertyFillers = $updatablePropertyFillers;
    }

    /**
     * {@inheritDoc}
     */
    public function fillUpdatableProperties(Combination $combination, UpdateCombinationCommand $command): array
    {
        $updatableProperties = [];

        foreach ($this->updatablePropertyFillers as $filler) {
            $properties = $filler->fillUpdatableProperties($combination, $command);

            if (empty($properties)) {
                continue;
            }

            $updatableProperties = array_merge($updatableProperties, $properties);
        }

        return $updatableProperties;
    }
}
