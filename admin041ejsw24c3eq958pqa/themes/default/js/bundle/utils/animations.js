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
 * Get the correct transition keyword of the browser.
 * @param {string} type - The property name (transition for example).
 * @param {string} lifecycle - Which lifecycle of the property name to catch (end, start...).
 * @return {string} The transition keywoard of the browser.
*/

// eslint-disable-next-line
function getAnimationEvent(type, lifecycle) {
  const el = document.createElement('element');
  const typeUpper = type.charAt(0).toUpperCase() + type.substring(1);
  const lifecycleUpper = lifecycle.charAt(0).toUpperCase() + lifecycle.substring(1);

  const properties = {
    transition: `${type}${lifecycle}`,
    OTransition: `o${typeUpper}${lifecycleUpper}`,
    MozTransition: `${type}${lifecycle}`,
    WebkitTransition: `webkit${typeUpper}${lifecycleUpper}`,
  };

  const key = Object.keys(properties).find((propKey) => el.style[propKey] !== undefined);

  return key !== undefined ? properties[key] : false;
}
