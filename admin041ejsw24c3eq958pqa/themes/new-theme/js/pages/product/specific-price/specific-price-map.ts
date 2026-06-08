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

export default {
  productIdInput: '#specific_price_product_id',
  formContainer: 'form[name="specific_price"]',
  currencyId: '#specific_price_groups_currency_id',
  customerSearchContainer: '#specific_price_customer',
  priceInput: '#specific_price_fixed_price',
  fixedPriceSymbol: '.js-fixed-price-row .input-group.money-type .input-group-append .input-group-text, '
    + '.js-fixed-price-row .input-group.money-type .input-group-prepend .input-group-text',
  leaveInitialPriceCheckbox: '#specific_price_leave_initial_price',
  reductionTypeSelect: '#specific_price_impact_reduction_type',
  reductionTypeAmountSymbol: '.price-reduction-value .input-group .input-group-append .input-group-text, '
    + '.price-reduction-value .input-group .input-group-prepend .input-group-text',
  includeTaxInputContainer: '.js-include-tax-row',
  customerItem: '#specific_price_customer_list .entity-item',
  switchReductionName: 'specific_price[impact][disabling_switch_reduction]',
  switchFixedName: 'specific_price[impact][disabling_switch_fixed_price_tax_excluded]',
  shopIdSelect: '#specific_price_groups_shop_id',
  combinationIdSelect: '#specific_price_combination_id',
};
