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

import ConfirmModal from '@components/modal';
import ProductMap from '@pages/product/product-map';

export default class ProductFooterManager {
  constructor() {
    this.initFooterButton(ProductMap.footer.deleteProductButton, ProductMap.footer.deleteProductModalId);
    this.initFooterButton(ProductMap.footer.duplicateProductButton, ProductMap.footer.duplicateProductModalId);
  }

  private initFooterButton(buttonId: string, modalId: string): void {
    const $footerButton = $(buttonId);
    $footerButton.on('click', () => {
      const modal = new ConfirmModal(
        {
          id: modalId,
          confirmTitle: $footerButton.data('modal-title'),
          confirmMessage: $footerButton.data('modal-message') ?? '',
          confirmButtonLabel: $footerButton.data('modal-apply'),
          closeButtonLabel: $footerButton.data('modal-cancel'),
          confirmButtonClass: $footerButton.data('confirm-button-class'),
          closable: true,
        },
        () => {
          const buttonUrl = $footerButton.data('buttonUrl');
          $(ProductMap.productFormSubmitButton).prop('disabled', true);

          const form = document.createElement('form');
          form.setAttribute('method', 'POST');
          form.setAttribute('action', buttonUrl);
          form.setAttribute('style', 'display: none;');
          document.body.appendChild(form);
          form.submit();
        },
      );
      modal.show();
    });
  }
}
