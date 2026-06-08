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
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataFormatter\CombinationListFormDataFormatter;

/**
 * This handler is used for ajax request performed from the combination list, it handles a list of combinations
 * whihc are (potentially) only a subset of all the product's combinations (since the list is paginated).
 */
class CombinationListFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var CombinationListFormDataFormatter
     */
    private $combinationListFormDataFormatter;

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
     * @param CommandBusInterface $commandBus
     * @param CombinationListFormDataFormatter $combinationListFormDataFormatter
     * @param CombinationCommandsBuilderInterface $commandsBuilder
     */
    public function __construct(
        CommandBusInterface $commandBus,
        CombinationListFormDataFormatter $combinationListFormDataFormatter,
        CombinationCommandsBuilderInterface $commandsBuilder,
        int $contextShopId,
        int $defaultShopId
    ) {
        $this->commandBus = $commandBus;
        $this->combinationListFormDataFormatter = $combinationListFormDataFormatter;
        $this->commandsBuilder = $commandsBuilder;
        $this->contextShopId = $contextShopId;
        $this->defaultShopId = $defaultShopId;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        // Does not handle creation. Combinations are created using different approach
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function update($productId, array $data)
    {
        $singleShopConstraint = $this->contextShopId ? ShopConstraint::shop($this->contextShopId) : ShopConstraint::shop($this->defaultShopId);

        // @todo: a hook system should be integrated in this handler for extendability
        foreach ($data as $combinationItemData) {
            $combinationData = $this->combinationListFormDataFormatter->format($combinationItemData);
            $commands = $this->commandsBuilder->buildCommands(new CombinationId((int) $combinationItemData['combination_id']), $combinationData, $singleShopConstraint);

            foreach ($commands as $command) {
                $this->commandBus->handle($command);
            }
        }
    }
}
