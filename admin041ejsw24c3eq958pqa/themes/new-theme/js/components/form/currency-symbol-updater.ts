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
 * Change symbol when the currency select is changed
 */
export default class CurrencySymbolUpdater {
  currencySymbolSelect: string;

  callbackChange: (symbol: string) => void;

  constructor(
    currencySymbolSelect: string,
    callbackChange: (symbol: string) => void,
  ) {
    this.currencySymbolSelect = currencySymbolSelect;
    this.callbackChange = callbackChange;

    this.init();
  }

  private init(): void {
    const selectCurrency = document.querySelector<HTMLSelectElement>(this.currencySymbolSelect);

    if (selectCurrency) {
      this.callbackChange(this.getSymbol(selectCurrency));

      selectCurrency.addEventListener('change', () => this.callbackChange(this.getSymbol(selectCurrency)));
    }
  }

  private getSymbol(select: HTMLSelectElement): string {
    const defaultCurrencySymbol: string = select.dataset.defaultCurrencySymbol ?? '';
    const selectItem = select.item(select.selectedIndex);

    if (!selectItem) {
      return defaultCurrencySymbol;
    }

    return selectItem.getAttribute('symbol') ?? defaultCurrencySymbol;
  }
}
