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

class TermsAndConditionsOptionHandler {
  constructor() {
    this.handle();

    $('input[name="general[enable_tos]"]').on('change', () => this.handle());
  }

  handle(): void {
    const tosEnabledVal = $('input[name="general[enable_tos]"]:checked').val();
    const isTosEnabled = parseInt(<string>tosEnabledVal, 10);

    this.handleTermsAndConditionsCmsSelect(isTosEnabled);
  }

  /**
   * If terms and conditions option is disabled, then terms and conditions
   * cms select must be disabled.
   *
   * @param {int} isTosEnabled
   */
  handleTermsAndConditionsCmsSelect(isTosEnabled: number): void {
    $('#form_general_tos_cms_id').prop('disabled', !isTosEnabled);
  }
}

export default TermsAndConditionsOptionHandler;
