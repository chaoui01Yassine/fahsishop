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

/**
 * Class AddressValidatorCore.
 *
 * Validates addresses held by common fahsishop objects (cart, customer...)
 */
class AddressValidatorCore
{
    /**
     * Validates cart addresses
     * Returns an array of invalid address IDs.
     *
     * @param Cart $cart
     *                   The cart holding the addresses to be inspected
     *
     * @return array
     *               The invalid address ids. Empty if everything is ok.
     */
    public function validateCartAddresses(Cart $cart)
    {
        $invalidAddressIds = [];
        $addressesIds = [
            $cart->id_address_delivery,
            $cart->id_address_invoice,
        ];

        foreach ($addressesIds as $idAddress) {
            $address = new CustomerAddress((int) $idAddress);

            try {
                $address->validateFields();
            } catch (PrestaShopException $e) {
                $invalidAddressIds[] = (int) $idAddress;
            }
        }

        return $invalidAddressIds;
    }

    /**
     * Validates given customer's addresses
     * Returns an array of invalid address IDs.
     *
     * @param Customer $customer
     *                           The customer holding the addresses to be inspected
     * @param Language $language
     *                           The language in which addresses should be validated
     *
     * @return array The invalid address ids. Empty if everything is ok.
     *               The invalid address ids. Empty if everything is ok.
     */
    public function validateCustomerAddresses(Customer $customer, Language $language)
    {
        $invalidAddresses = [];
        $addresses = $customer->getAddresses($language->id);

        if (is_array($addresses)) {
            foreach ($addresses as $address) {
                try {
                    $adressObject = new CustomerAddress((int) $address['id_address']);
                    $adressObject->validateFields();
                } catch (PrestaShopException $e) {
                    $invalidAddresses[] = (int) $address['id_address'];
                }
            }
        }

        return $invalidAddresses;
    }
}
