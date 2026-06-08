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
import {Grid} from '@js/types/grid';
import GridMap from '@components/grid/grid-map';

const {$} = window;

/**
 * Class SubmitGridActionExtension handles grid action submits
 */
export default class SubmitGridActionExtension {
  extend(grid: Grid): void {
    grid
      .getHeaderContainer()
      .on(
        'click',
        GridMap.bulks.gridSubmitAction,
        (event: JQueryEventObject) => {
          this.handleSubmit(event, grid);
        },
      );
  }

  /**
   * Handle grid action submit.
   * It uses grid form to submit actions.
   *
   * @param {Event} event
   * @param {Grid} grid
   *
   * @private
   */
  private handleSubmit(event: JQueryEventObject, grid: Grid): void {
    const $submitBtn = $(event.currentTarget);
    const confirmMessage = $submitBtn.data('confirm-message');

    if (
      typeof confirmMessage !== 'undefined'
      && confirmMessage.length > 0
      && !window.confirm(confirmMessage)
    ) {
      return;
    }

    const $form = $(GridMap.filterForm(grid.getId()));

    $form.attr('action', $submitBtn.data('url'));
    $form.attr('method', $submitBtn.data('method'));
    $form
      .find(GridMap.actions.tokenInput(grid.getId()))
      .val($submitBtn.data('csrf'));
    $form.submit();
  }
}
