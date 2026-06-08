<?php
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

namespace PrestaShopBundle\Api;

class QueryStockParamsCollection extends QueryParamsCollection
{
    /**
     * @param array $queryParams
     *
     * @return array|mixed
     */
    protected function parseOrderParams(array $queryParams)
    {
        $queryParams = parent::parseOrderParams($queryParams);

        if (array_key_exists('low_stock', $queryParams) && 1 == $queryParams['low_stock']) {
            array_unshift($queryParams['order'], 'product_low_stock_alert desc');
        }

        return $queryParams;
    }

    /**
     * @return array
     */
    protected function getValidFilterParams()
    {
        return [
            'productId',
            'supplier_id',
            'category_id',
            'keywords',
            'attributes',
            'features',
            'active',
        ];
    }

    /**
     * @return array
     */
    protected function getValidOrderParams()
    {
        return [
            'product',
            'product_id',
            'product_name',
            'combination_id',
            'reference',
            'supplier',
            'available_quantity',
            'physical_quantity',
            'active',
            'low_stock',
        ];
    }

    /**
     * @param array $queryParams
     *
     * @return mixed
     */
    protected function setDefaultOrderParam($queryParams)
    {
        $queryParams['order'] = ['product_id DESC'];

        return $queryParams;
    }
}
