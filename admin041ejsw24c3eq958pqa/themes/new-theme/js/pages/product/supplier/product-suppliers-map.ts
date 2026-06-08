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

export default (productSuppliersId: string): Record<string, any> => {
  // eslint-disable-next-line max-len
  const productSupplierInputId = (supplierIndex: string, inputName: string): string => `${productSuppliersId}_${supplierIndex}_${inputName}`;

  return {
    productSuppliersCollection: `${productSuppliersId}`,
    productSuppliersCollectionRow: '.product-suppliers-collection-row',
    productSuppliersTable: `${productSuppliersId} table`,
    productsSuppliersTableBody: `${productSuppliersId} table tbody`,
    productsSuppliersRows: `${productSuppliersId} table tbody .product_supplier_row`,
    productsSupplierRowSelector: '.product_supplier_row',
    productSupplierRow: {
      supplierIdInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'supplier_id'),
      supplierNameInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'supplier_name'),
      productSupplierIdInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'product_supplier_id'),
      referenceInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'reference'),
      priceInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'price_tax_excluded'),
      currencyIdInput: (supplierIndex: string): string => productSupplierInputId(supplierIndex, 'currency_id'),
      supplierNamePreview: (supplierIndex: string): string => `#product_supplier_row_${supplierIndex} .supplier_name .preview`,
      currencySymbol: (supplierIndex: string): string => `#product_supplier_row_${supplierIndex} .money-type .input-group-text`,
    },
  };
};
