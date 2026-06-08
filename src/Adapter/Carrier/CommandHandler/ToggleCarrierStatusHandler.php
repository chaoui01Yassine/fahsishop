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

namespace PrestaShop\PrestaShop\Adapter\Carrier\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Carrier\AbstractCarrierHandler;
use PrestaShop\PrestaShop\Core\Domain\Carrier\Command\ToggleCarrierStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\Carrier\CommandHandler\ToggleCarrierStatusHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Carrier\Exception\CannotToggleCarrierStatusException;
use PrestaShop\PrestaShop\Core\Domain\Carrier\Exception\CarrierException;
use PrestaShopException;

/**
 * Handles command that toggle carrier status
 */
class ToggleCarrierStatusHandler extends AbstractCarrierHandler implements ToggleCarrierStatusHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(ToggleCarrierStatusCommand $command)
    {
        $carrier = $this->getCarrier($command->getCarrierId());

        try {
            if (false === $carrier->toggleStatus()) {
                throw new CannotToggleCarrierStatusException(sprintf('Unable to toggle status of carrier with id "%d"', $command->getCarrierId()->getValue()), CannotToggleCarrierStatusException::SINGLE_TOGGLE);
            }
        } catch (PrestaShopException $e) {
            throw new CarrierException(sprintf('An error occurred when toggling status of carrier with id "%d"', $command->getCarrierId()->getValue()), 0, $e);
        }
    }
}
