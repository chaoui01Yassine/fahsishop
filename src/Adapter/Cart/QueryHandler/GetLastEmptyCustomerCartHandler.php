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

namespace PrestaShop\PrestaShop\Adapter\Cart\QueryHandler;

use Customer;
use PrestaShop\PrestaShop\Core\Domain\Cart\Exception\CartConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Cart\Exception\CartException;
use PrestaShop\PrestaShop\Core\Domain\Cart\Exception\CartNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\Cart\Query\GetLastEmptyCustomerCart;
use PrestaShop\PrestaShop\Core\Domain\Cart\QueryHandler\GetLastEmptyCustomerCartHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Cart\ValueObject\CartId;
use PrestaShop\PrestaShop\Core\Domain\Customer\Exception\CustomerNotFoundException;
use PrestaShopException;

/**
 * Gets last empty cart for customer using legacy object model
 */
final class GetLastEmptyCustomerCartHandler implements GetLastEmptyCustomerCartHandlerInterface
{
    /**
     * @param GetLastEmptyCustomerCart $query
     *
     * @return CartId
     *
     * @throws CartException
     * @throws CartNotFoundException
     * @throws CustomerNotFoundException
     * @throws CartConstraintException
     */
    public function handle(GetLastEmptyCustomerCart $query): CartId
    {
        $customerId = $query->getCustomerId()->getValue();

        try {
            $customer = new Customer($customerId);

            if ($customer->id !== $customerId) {
                throw new CustomerNotFoundException(sprintf('Customer with id "%d" was not found.', $customerId));
            }

            $cartId = $customer->getLastEmptyCart(false);

            if (false === $cartId) {
                throw new CartNotFoundException(sprintf('Empty cart not found for customer with id "%s"', $customerId));
            }
        } catch (PrestaShopException $e) {
            throw new CartException(sprintf('An error occurred while trying to find empty cart for customer with id "%s"', $customerId));
        }

        return new CartId($cartId);
    }
}
