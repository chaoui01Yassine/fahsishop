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

namespace PrestaShop\PrestaShop\Adapter\Zone\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Domain\AbstractObjectModelHandler;
use PrestaShop\PrestaShop\Core\Domain\Zone\Command\AddZoneCommand;
use PrestaShop\PrestaShop\Core\Domain\Zone\CommandHandler\AddZoneHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Zone\Exception\MissingZoneRequiredFieldsException;
use PrestaShop\PrestaShop\Core\Domain\Zone\Exception\ZoneException;
use PrestaShop\PrestaShop\Core\Domain\Zone\ValueObject\ZoneId;
use PrestaShopException;
use Zone;

/**
 * Handles command that adds new zone.
 */
final class AddZoneHandler extends AbstractObjectModelHandler implements AddZoneHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(AddZoneCommand $command): ZoneId
    {
        $zone = new Zone();
        $zone->name = $command->getName();
        $zone->active = $command->isEnabled();

        try {
            $errors = $zone->validateFieldsRequiredDatabase();
            if (!empty($errors)) {
                $missingFields = array_keys($errors);

                throw new MissingZoneRequiredFieldsException($missingFields, sprintf('One or more required fields for zone are missing. Missing fields are: %s', implode(', ', $missingFields)));
            }

            if (!$zone->add()) {
                throw new ZoneException(sprintf('Failed to add new zone "%s"', $command->getName()));
            }

            $this->associateWithShops($zone, $command->getShopAssociation());
        } catch (PrestaShopException $e) {
            throw new ZoneException(sprintf('Failed to add new zone "%s"', $command->getName()));
        }

        return new ZoneId((int) $zone->id);
    }
}
