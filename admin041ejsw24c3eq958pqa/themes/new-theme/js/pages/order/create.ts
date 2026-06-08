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
import CreateOrderPage from './create/create-order-page';

const {$} = window;
let orderPageManager: CreateOrderPage | null = null;

/**
 * proxy to allow other scripts within the page to trigger the search
 * @param string
 */
function searchCustomerByString(string: string): void {
  if (orderPageManager !== null) {
    orderPageManager.search(string);
  } else {
    console.log('Error: Could not search customer as orderPageManager is null');
  }
}

/**
 * proxy to allow other scripts within the page to refresh addresses list
 */
function refreshAddressesList(refreshCartAddresses: boolean): void {
  if (orderPageManager !== null) {
    orderPageManager.refreshAddressesList(refreshCartAddresses);
  } else {
    console.log('Error: Could not refresh addresses list as orderPageManager is null');
  }
}

/**
 * proxy to allow other scripts within the Create Order page to refresh cart
 */
function refreshCart(): void {
  if (orderPageManager === null) {
    console.log('Error: Could not refresh addresses list as orderPageManager is null');
    return;
  }
  orderPageManager.refreshCart();
}

$(document).ready(() => {
  orderPageManager = new CreateOrderPage();
});

export {searchCustomerByString};
export {refreshAddressesList};
export {refreshCart};
