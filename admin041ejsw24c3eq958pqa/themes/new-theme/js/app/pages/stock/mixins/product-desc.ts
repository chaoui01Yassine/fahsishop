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
import {defineComponent} from 'vue';

interface ProductDescProps {
  product: Record<string, any>;
  thumbnail?: string;
  hasCombination?: boolean;
}

export default defineComponent<ProductDescProps>({
  computed: {
    thumbnail(): string | undefined {
      if (this.product.combination_thumbnail !== 'N/A') {
        return `${this.product.combination_thumbnail}`;
      }

      if (this.product.product_thumbnail !== 'N/A') {
        return `${this.product.product_thumbnail}`;
      }

      return undefined;
    },

    combinationName(): string {
      const combinations = this.product.combination_name.split(',');
      const attributes = this.product.attribute_name.split(',');
      const separator = ' - ';
      let attr = '';

      combinations.forEach((attribute: string, index: string) => {
        const value = attribute.trim().slice(attributes[index].trim().length + separator.length);
        attr += attr.length ? ` - ${value}` : value;
      });

      return attr;
    },

    hasCombination() {
      return !!this.product.combination_id;
    },
  },
});
