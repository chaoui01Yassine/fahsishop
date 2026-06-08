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
// @ts-ignore-next-line
import Jets from 'jets/jets';

export default function (search: typeof Jets): void {
  $('.reset-translation-value').each((buttonIndex, button) => {
    const $editTranslationForm = $(button).parents('form');
    const defaultTranslationValue = $editTranslationForm
      .find('*[name=default]')
      .val();

    $(button).click(() => {
      $editTranslationForm
        .find('*[name=translation_value]')
        .val(<string>defaultTranslationValue);
      $editTranslationForm.submit();
    });
  });

  const showFlashMessageOnEdit = (form: HTMLElement) => {
    $(form).submit((event) => {
      event.preventDefault();

      const $editTranslationForm = $(event.target);
      const url = $editTranslationForm.attr('action');

      $.post(<string>url, $editTranslationForm.serialize(), (response) => {
        let flashMessage: JQuery;

        if (response.successful_update) {
          flashMessage = $editTranslationForm.find('.alert-info');

          // Propagate edition
          const hash = $editTranslationForm.data('hash');
          const $editTranslationForms = $(`[data-hash=${hash}]`);
          const $translationValueFields = $(
            $editTranslationForms.find('textarea'),
          );
          $translationValueFields.val(
            <string>$editTranslationForm.find('textarea').val(),
          );

          // Refresh search index
          $editTranslationForms.removeAttr('data-jets');
          search.update();
        } else {
          flashMessage = $editTranslationForm.find('.alert-danger');
        }

        flashMessage.removeClass('hide');

        setTimeout(() => {
          flashMessage.addClass('hide');
        }, 4000);
      });

      return false;
    });
  };

  $('#jetsContent form, .translation-domain form').each((formIndex, form) => {
    showFlashMessageOnEdit(form);
  });
}
