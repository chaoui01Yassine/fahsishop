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

import ComponentsMap from '@components/components-map';

const {$} = window;

/**
 * Component responsible for filtering select values by language selected.
 */
export default class TranslatableChoice {
  constructor() {
    // registers the event which displays the popover
    $(document).on(
      'change',
      ComponentsMap.form.selectLanguage,
      (event: JQueryEventObject) => {
        this.filterSelect(event);
      },
    );

    $('select.translatable_choice_language').trigger('change');
  }

  filterSelect(event: JQueryEventObject): void {
    const $element = $(event.currentTarget);
    const $formGroup = $element.closest('.form-group');
    const language = $element.find('option:selected').val();

    // show all the languages selects
    $formGroup
      .find(ComponentsMap.form.selectChoice(<string>language))
      .parent()
      .show();

    const $selects = $formGroup.find('select.translatable_choice');

    // Hide all the selects not corresponding to the language selected
    $selects
      .not(ComponentsMap.form.selectChoice(<string>language))
      .each((index, item) => {
        $(item)
          .parent()
          .hide();
      });

    // Bind choice selection to fill the hidden input
    this.bindValueSelection($selects);
  }

  bindValueSelection($selects: JQuery): void {
    $selects.each((index, element) => {
      $(element).on('change', (event) => {
        const $select = $(event.currentTarget);
        const selectId = $select.attr('id');
        const selectedValue = $select.find('option:selected').val();
        $(`#${selectId}_value`).val(<string>selectedValue);
      });
    });
  }
}
