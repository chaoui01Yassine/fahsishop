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
import IframeEvent from '@components/modal/iframe-event';

/**
 * Client to integrate in a iframe in order to communicate with the parent window via some events.
 * The parent window needs to register to the IframeEvent:
 *
 * window.addEventListener(IframeEvent.parentWindowEvent, (event: IframeEvent) => {
 *   if (event.name === 'iframeAction') {
 *     doAction(event.parameters);
 *   }
 * });
 */
export default class IframeClient {
  private iframeWindow: Window;

  private parentWindow: Window;

  constructor() {
    this.iframeWindow = window;
    this.parentWindow = this.iframeWindow.parent;
  }

  dispatchEvent(eventName: string, parameters: any = {}): void {
    this.parentWindow.dispatchEvent(new IframeEvent(eventName, parameters));
  }
}
