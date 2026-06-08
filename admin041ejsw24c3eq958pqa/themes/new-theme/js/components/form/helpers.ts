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
 * Used to display errors fetched from fahsishop API in a JSON format.
 * The expected format looks like this:
 * {
 *   errors: {
 *     price: 'Invalid negative value',
 *     name: 'Forbidden blank value',
 *   },
 * }
 *
 * @param jsonResponse
 */
export function notifyFormErrors(jsonResponse: any): void {
  Object.keys(jsonResponse.errors).forEach((field: string) => {
    if (Object.prototype.hasOwnProperty.call(jsonResponse.errors, field)) {
      let fieldErrors: string[];

      if (Array.isArray(jsonResponse.errors[field])) {
        fieldErrors = jsonResponse.errors[field];
      } else {
        fieldErrors = [jsonResponse.errors[field]];
      }

      fieldErrors.forEach((error: string) => {
        $.growl.error({message: `${field}: ${error}`});
      });
    }
  });
};

export default {
  notifyFormErrors,
};
