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

namespace PrestaShop\PrestaShop\Core\Domain\Contact\Exception;

/**
 * holds all validation constraints that are used together with contact entity.
 */
class ContactConstraintException extends ContactException
{
    /**
     * @var int - error is raised when preg match fails to validate according to regex /^[^<>={}]*$/u
     */
    public const INVALID_TITLE = 1;

    /**
     * @var int - error is raised when a value in array is not integer type
     */
    public const INVALID_SHOP_ASSOCIATION = 2;

    /**
     * @var int - error is raised when CleanHtml constraint validation fails
     */
    public const INVALID_DESCRIPTION = 3;

    /**
     * @var int - error is raised when an array does not have the default language value. It might not exist or is empty.
     *          DefaultLanguage constraint is used here.
     */
    public const MISSING_TITLE_FOR_DEFAULT_LANGUAGE = 4;
}
