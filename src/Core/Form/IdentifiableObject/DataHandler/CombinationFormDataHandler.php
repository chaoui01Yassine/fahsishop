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
use PrestaShop\PrestaShop\Core\Domain\Product\Combination\ValueObject\CombinationId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\CommandBuilder\Product\Combination\CombinationCommandsBuilderInterface;

/**
 * Handles data posted from combination form
 */
class CombinationFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $bus;

    /**
     * @var CombinationCommandsBuilderInterface
     */
    private $commandsBuilder;

    /**
     * @var int
     */
    private $contextShopId;

    /**
     * @var int
     */
    private $defaultShopId;

    /**
     * @param CommandBusInterface $bus
     * @param CombinationCommandsBuilderInterface $commandsBuilder
     */
    public function __construct(
        CommandBusInterface $bus,
        CombinationCommandsBuilderInterface $commandsBuilder,
        int $contextShopId,
        int $defaultShopId
    ) {
        $this->bus = $bus;
        $this->commandsBuilder = $commandsBuilder;
        $this->contextShopId = $contextShopId;
        $this->defaultShopId = $defaultShopId;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        // Not used for creation
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $singleShopConstraint = $this->contextShopId ? ShopConstraint::shop($this->contextShopId) : ShopConstraint::shop($this->defaultShopId);

        $commands = $this->commandsBuilder->buildCommands(new CombinationId($id), $data, $singleShopConstraint);

        foreach ($commands as $command) {
            $this->bus->handle($command);
        }
    }
}
