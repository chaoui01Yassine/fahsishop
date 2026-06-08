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

namespace PrestaShop\PrestaShop\Core\Domain\Zone\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Zone\Exception\ZoneException;

/**
 * Defines Zone ID with it's constraints
 */
class ZoneId
{
    /**
     * @var int
     */
    private $zoneId;

    /**
     * @param int $zoneId
     *
     * @throws ZoneException
     */
    public function __construct(int $zoneId)
    {
        $this->assertIntegerIsGreaterThanZero($zoneId);
        $this->zoneId = $zoneId;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     *
     * @throws ZoneException
     */
    private function assertIntegerIsGreaterThanZero(int $zoneId): void
    {
        if (0 >= $zoneId) {
            throw new ZoneException(sprintf('Zone id %d is invalid. Zone id have to be number bigger than zero.', $zoneId));
        }
    }
}
