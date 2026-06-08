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

import Router from '@components/router';
import OrderViewPageMap from '@pages/order/OrderViewPageMap';

const {$} = window;

export default class OrderInvoicesRefresher {
  router: Router;

  constructor() {
    this.router = new Router();
  }

  refresh(orderId: number): void {
    $.getJSON(this.router.generate('admin_orders_get_invoices', {orderId}))
      .then((response) => {
        if (!response || !response.invoices || Object.keys(response.invoices).length <= 0) {
          return;
        }

        const $paymentInvoiceSelect = $(OrderViewPageMap.orderPaymentInvoiceSelect);
        const $addProductInvoiceSelect = $(OrderViewPageMap.productAddInvoiceSelect);
        const $existingInvoicesGroup = $addProductInvoiceSelect.find('optgroup:first');
        const $productEditInvoiceSelect = $(OrderViewPageMap.productEditInvoiceSelect);
        const $addDiscountInvoiceSelect = $(OrderViewPageMap.addCartRuleInvoiceIdSelect);
        $existingInvoicesGroup.empty();
        $paymentInvoiceSelect.empty();
        $productEditInvoiceSelect.empty();
        $addDiscountInvoiceSelect.empty();

        Object.keys(response.invoices).forEach((invoiceName) => {
          const invoiceId = response.invoices[invoiceName];
          const invoiceNameWithoutPrice = invoiceName.split(' - ')[0];

          $existingInvoicesGroup.append(`<option value="${invoiceId}">${invoiceNameWithoutPrice}</option>`);
          $paymentInvoiceSelect.append(`<option value="${invoiceId}">${invoiceNameWithoutPrice}</option>`);
          $productEditInvoiceSelect.append(`<option value="${invoiceId}">${invoiceNameWithoutPrice}</option>`);
          $addDiscountInvoiceSelect.append(`<option value="${invoiceId}">${invoiceName}</option>`);
        });

        const productAddSelect = <HTMLSelectElement>document.querySelector(OrderViewPageMap.productAddInvoiceSelect);

        if (productAddSelect) {
          productAddSelect.selectedIndex = 0;
        }
      });
  }
}
