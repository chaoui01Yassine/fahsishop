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

namespace PrestaShop\PrestaShop\Core\Domain\Manufacturer\Command;

use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Exception\ManufacturerConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\ValueObject\ManufacturerId;

/**
 * Toggles manufacturer status
 */
class ToggleManufacturerStatusCommand
{
    /**
     * @var ManufacturerId
     */
    private $manufacturerId;

    /**
     * @var bool
     */
    private $expectedStatus;

    /**
     * @param int $manufacturerId
     * @param bool $expectedStatus
     *
     * @throws ManufacturerConstraintException
     */
    public function __construct($manufacturerId, $expectedStatus)
    {
        $this->assertIsBool($expectedStatus);
        $this->expectedStatus = $expectedStatus;
        $this->manufacturerId = new ManufacturerId($manufacturerId);
    }

    /**
     * @return ManufacturerId
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * @return bool
     */
    public function getExpectedStatus()
    {
        return $this->expectedStatus;
    }

    /**
     * Validates that value is of type boolean
     *
     * @param bool $value
     *
     * @throws ManufacturerConstraintException
     */
    private function assertIsBool($value)
    {
        if (!is_bool($value)) {
            throw new ManufacturerConstraintException(sprintf('Status must be of type bool, but given %s', var_export($value, true)), ManufacturerConstraintException::INVALID_STATUS);
        }
    }
}
