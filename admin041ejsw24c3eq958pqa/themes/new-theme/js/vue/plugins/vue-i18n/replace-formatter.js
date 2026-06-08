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
 * This formatter is used by VueI18n, the basic format for variables looks
 * like 'Hi {name}' or 'Hi {0}' Sadly it doesn't match the fahsishop usual
 * placeholders format.
 * So this custom formatter allows us to simple replace in order to use formats
 * like 'Hi %name%' the parameters then should be an object like {'%name%': 'John'}
 */
export default class ReplaceFormatter {
  /**
   * @param message {string}
   * @param values {object}
   *
   * @returns {array}
   */
  interpolate(message, values) {
    if (!values) {
      return [message];
    }

    let msg = message;
    Object.keys(values).forEach((param) => {
      let placeholder = param;

      // If the param doesn't use PrestaShop formatting (with %) nor Symfony usual one (with {})
      // then we fallback to VueI18n usual one which uses `{param}`
      if (placeholder.indexOf('%') === -1 && placeholder.indexOf('{') === -1) {
        placeholder = `{${placeholder}}`;
      }
      msg = msg.replace(placeholder, values[param]);
    });

    return [msg];
  }
}
