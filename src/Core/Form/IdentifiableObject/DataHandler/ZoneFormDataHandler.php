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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Zone\Command\AddZoneCommand;
use PrestaShop\PrestaShop\Core\Domain\Zone\Command\EditZoneCommand;
use PrestaShop\PrestaShop\Core\Domain\Zone\Exception\ZoneException;

/**
 * Handles submitted zone form data.
 */
final class ZoneFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Create object from form data.
     *
     * @param array $data
     *
     * @return int
     */
    public function create(array $data): int
    {
        if (empty($data['shop_association'])) {
            $data['shop_association'] = [];
        }

        $addZoneCommand = new AddZoneCommand($data['name'], $data['enabled'], $data['shop_association']);
        $zoneId = $this->commandBus->handle($addZoneCommand);

        return $zoneId->getValue();
    }

    /**
     * {@inheritdoc}
     *
     * @throws ZoneException
     */
    public function update($id, array $data): void
    {
        $command = (new EditZoneCommand($id))
            ->setName((string) $data['name'])
            ->setEnabled((bool) $data['enabled']);

        if (isset($data['shop_association'])) {
            $shopAssociation = $data['shop_association'] ?: [];
            $shopAssociation = array_map('intval', $shopAssociation);

            $command->setShopAssociation($shopAssociation);
        }

        $this->commandBus->handle($command);
    }
}
