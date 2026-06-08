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

namespace PrestaShop\PrestaShop\Adapter\Cart\CommandHandler;

use Cart;
use Configuration;
use Currency;
use Customer;
use PrestaShop\PrestaShop\Core\Domain\Cart\Command\CreateEmptyCustomerCartCommand;
use PrestaShop\PrestaShop\Core\Domain\Cart\CommandHandler\CreateEmptyCustomerCartHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Cart\ValueObject\CartId;
use PrestaShopException;

/**
 * @internal
 */
final class CreateEmptyCustomerCartHandler implements CreateEmptyCustomerCartHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(CreateEmptyCustomerCartCommand $command)
    {
        $customer = new Customer($command->getCustomerId()->getValue());

        $lastEmptyCartId = $customer->getLastEmptyCart(false);

        if ($lastEmptyCartId) {
            $cart = new Cart($lastEmptyCartId);
        } else {
            $cart = $this->createEmptyCustomerCart($customer);
        }

        return new CartId((int) $cart->id);
    }

    /**
     * @param Customer $customer
     *
     * @return Cart
     *
     * @throws PrestaShopException
     */
    private function createEmptyCustomerCart(Customer $customer): Cart
    {
        $cart = new Cart();

        $cart->recyclable = false;
        $cart->gift = false;
        $cart->id_customer = $customer->id;
        $cart->secure_key = $customer->secure_key;

        $cart->id_shop = $customer->id_shop;
        $cart->id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        $cart->id_currency = Currency::getDefaultCurrencyId();

        $addresses = $customer->getAddresses($cart->id_lang);
        $addressId = !empty($addresses) ? (int) reset($addresses)['id_address'] : null;
        $cart->id_address_delivery = $addressId;
        $cart->id_address_invoice = $addressId;

        $cart->setNoMultishipping();
        $cart->save();

        return $cart;
    }
}
