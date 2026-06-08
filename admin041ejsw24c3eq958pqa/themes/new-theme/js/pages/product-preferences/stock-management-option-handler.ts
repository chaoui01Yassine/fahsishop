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

const {$} = window;

class StockManagementOptionHandler {
  constructor() {
    this.handle();

    $('input[name="stock[stock_management]"]').on('change', () => this.handle(),
    );
  }

  handle(): void {
    const stockManagementVal = $(
      'input[name="stock[stock_management]"]:checked',
    ).val();
    const isStockManagementEnabled = parseInt(<string>stockManagementVal, 10);

    this.handleAllowOrderingOutOfStockOption(isStockManagementEnabled);
    this.handleDisplayAvailableQuantitiesOption(isStockManagementEnabled);
  }

  /**
   * If stock managament is disabled
   * then 'Allow ordering of out-of-stock products' option must be Yes and disabled
   * otherwise it should be enabled
   *
   * @param {int} isStockManagementEnabled
   */
  handleAllowOrderingOutOfStockOption(isStockManagementEnabled: number): void {
    const allowOrderingOosRadios = $('input[name="stock[allow_ordering_oos]"]');

    if (isStockManagementEnabled) {
      allowOrderingOosRadios.removeAttr('disabled');
    } else {
      allowOrderingOosRadios.val(['1']);
      allowOrderingOosRadios.attr('disabled', 'disabled');
    }
  }

  /**
   * If stock managament is disabled
   * then 'Display available quantities on the product page' option must be No and disabled
   * otherwise it should be enabled
   *
   * @param {int} isStockManagementEnabled
   */
  handleDisplayAvailableQuantitiesOption(
    isStockManagementEnabled: number,
  ): void {
    const displayQuantitiesRadio = $('input[name="page[display_quantities]"]');

    if (isStockManagementEnabled) {
      displayQuantitiesRadio.removeAttr('disabled');
    } else {
      displayQuantitiesRadio.val(['0']);
      displayQuantitiesRadio.attr('disabled', 'disabled');
    }
  }
}

export default StockManagementOptionHandler;
