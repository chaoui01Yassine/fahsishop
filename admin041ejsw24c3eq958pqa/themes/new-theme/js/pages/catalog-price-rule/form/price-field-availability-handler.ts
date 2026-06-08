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

/**
 * Enables/disables 'price' field depending from 'leave_initial_price' field checkbox value
 */
export default class PriceFieldAvailabilityHandler {
  $sourceSelector: JQuery;

  $targetSelector: JQuery;

  constructor(checkboxSelector: string, targetSelector: string) {
    this.$sourceSelector = $(checkboxSelector);
    this.$targetSelector = $(targetSelector);
    this.handle();
    this.$sourceSelector.on('change', () => this.handle());
  }

  /**
   * When checkbox value is 1, target field is disabled, else enabled
   *
   * @private
   */
  private handle(): void {
    const checkboxVal = this.$sourceSelector.is(':checked');

    this.$targetSelector.prop('disabled', checkboxVal);
  }
}
