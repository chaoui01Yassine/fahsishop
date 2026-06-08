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

namespace PrestaShop\PrestaShop\Adapter\Order\CommandHandler;

use Currency;
use OrderInvoice;
use PrestaShop\PrestaShop\Adapter\Order\AbstractOrderHandler;
use PrestaShop\PrestaShop\Core\Domain\Order\Exception\OrderException;
use PrestaShop\PrestaShop\Core\Domain\Order\Payment\Command\AddPaymentCommand;
use PrestaShop\PrestaShop\Core\Domain\Order\Payment\CommandHandler\AddPaymentHandlerInterface;
use Validate;

/**
 * @internal
 */
final class AddPaymentHandler extends AbstractOrderHandler implements AddPaymentHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(AddPaymentCommand $command)
    {
        $order = $this->getOrder($command->getOrderId());

        $currency = new Currency($command->getPaymentCurrencyId()->getValue());
        $orderHasInvoice = $order->hasInvoice();

        if ($orderHasInvoice) {
            $orderInvoice = new OrderInvoice($command->getOrderInvoiceId());
        } else {
            $orderInvoice = null;
        }

        if (!Validate::isLoadedObject($currency)) {
            throw new OrderException('The selected currency is invalid.');
        }

        if ($orderHasInvoice && !Validate::isLoadedObject($orderInvoice)) {
            throw new OrderException('The invoice is invalid.');
        }

        $paymentAdded = $order->addOrderPayment(
            (string) $command->getPaymentAmount(),
            $command->getPaymentMethod(),
            $command->getPaymentTransactionId(),
            $currency,
            $command->getPaymentDate()->format('Y-m-d H:i:s'),
            $orderInvoice,
            $command->getEmployeeId()->getValue()
        );

        if (!$paymentAdded) {
            throw new OrderException('An error occurred during payment.');
        }
    }
}
