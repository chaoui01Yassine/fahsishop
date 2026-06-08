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

namespace PrestaShop\PrestaShop\Adapter\Product;

use Symfony\Component\HttpFoundation\Request;

/**
 * @deprecated since 8.1 and will be removed in next major.
 *
 * Extracted from Product Controller, used to cleanup the request.
 * For internal use only.
 */
final class FilterCategoriesRequestPurifier
{
    public const CATEGORY = 'filter_category';

    /**
     * Changes the filter category values in case it is not numeric or signed.
     *
     * @param Request $request
     *
     * @return Request
     */
    public function purify(Request $request)
    {
        if ($request->isMethod('POST')) {
            $value = $request->request->get(self::CATEGORY);
            if (null !== $value && (!is_numeric($value) || $value < 0)) {
                $request->request->set(self::CATEGORY, '');
            }
        }

        return $request;
    }
}
