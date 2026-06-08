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

import {EventEmitter} from '@components/event-emitter';
import Router from '@components/router';
import eventMap from './event-map';
import SummaryRenderer from './summary-renderer';

const {$} = window;

/**
 * Manages summary block
 */
export default class SummaryManager {
  router: Router;

  summaryRenderer: SummaryRenderer;

  constructor() {
    this.router = new Router();
    this.summaryRenderer = new SummaryRenderer();
    this.initListeners();
  }

  /**
   * Inits event listeners
   *
   * @private
   */
  private initListeners(): void {
    this.onProcessOrderEmailError();
    this.onProcessOrderEmailSuccess();
  }

  /**
   * Listens for process order email sending success event
   *
   * @private
   */
  private onProcessOrderEmailSuccess(): void {
    EventEmitter.on(eventMap.processOrderEmailSent, (response) => {
      this.summaryRenderer.cleanAlerts();
      this.summaryRenderer.renderSuccessMessage(response.message);
    });
  }

  /**
   * Listens for process order email failed event
   *
   * @private
   */
  private onProcessOrderEmailError(): void {
    EventEmitter.on(eventMap.processOrderEmailFailed, (response) => {
      this.summaryRenderer.cleanAlerts();
      this.summaryRenderer.renderErrorMessage(response.responseJSON.message);
    });
  }

  /**
   * Sends email to customer with link of order processing
   *
   * @param {Number} cartId
   */
  sendProcessOrderEmail(cartId: number): void {
    $.post(this.router.generate('admin_orders_send_process_order_email'), {
      cartId,
    })
      .then((response) => EventEmitter.emit(eventMap.processOrderEmailSent, response),
      )
      .catch((e) => {
        EventEmitter.emit(eventMap.processOrderEmailFailed, e);
      });
  }
}
