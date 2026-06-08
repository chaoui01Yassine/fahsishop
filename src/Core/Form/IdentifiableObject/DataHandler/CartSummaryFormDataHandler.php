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
use PrestaShop\PrestaShop\Core\Domain\Order\Command\AddOrderFromBackOfficeCommand;

/**
 * Handles cart summary data
 */
class CartSummaryFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var int
     */
    private $contextEmployeeId;

    /**
     * @param CommandBusInterface $commandBus
     * @param int $contextEmployeeId
     */
    public function __construct(
        CommandBusInterface $commandBus,
        int $contextEmployeeId
    ) {
        $this->commandBus = $commandBus;
        $this->contextEmployeeId = $contextEmployeeId;
    }

    /**
     * Creates new Order from cart summary
     *
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return $this->commandBus->handle(new AddOrderFromBackOfficeCommand(
            (int) $data['cart_id'],
            (int) $this->contextEmployeeId,
            $data['order_message'],
            $data['payment_module'],
            (int) $data['order_state']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        // not used for edition, only creation
    }
}
