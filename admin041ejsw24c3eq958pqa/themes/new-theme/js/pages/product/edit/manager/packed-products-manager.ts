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

import EntitySearchInput from '@components/entity-search-input';
import ProductMap from '@pages/product/product-map';
import ProductEventMap from '@pages/product/product-event-map';
import {EventEmitter} from 'events';

export default class PackedProductsManager {
  private eventEmitter: EventEmitter;

  private entitySearchInput: EntitySearchInput;

  constructor(eventEmitter: EventEmitter) {
    this.eventEmitter = eventEmitter;
    const $searchInput = $(ProductMap.packedProducts.searchInput);
    const referenceLabel = $searchInput.data('referenceLabel') ?? '(Ref: %s)';
    this.entitySearchInput = new EntitySearchInput($searchInput, {
      onRemovedContent: () => this.eventEmitter.emit(ProductEventMap.updateSubmitButtonState),
      onSelectedContent: () => this.eventEmitter.emit(ProductEventMap.updateSubmitButtonState),
      suggestionTemplate: (combination: any) => {
        let reference = '';

        if (combination.reference) {
          reference = `<span class="combination-reference">(${combination.reference})</span>`;
        }

        return `<div class="search-suggestion"><img src="${combination.image}" /> ${combination.name}${reference}</div>`;
      },
      responseTransformer: (response: any) => {
        Object.keys(response).forEach((key) => {
          if (Object.prototype.hasOwnProperty.call(response, key)) {
            const combination = response[key];

            if (combination.reference) {
              // eslint-disable-next-line no-param-reassign
              response[key].reference = referenceLabel.replace('%s', combination.reference);
            }
          }
        });

        return response;
      },
    });
  }
}
