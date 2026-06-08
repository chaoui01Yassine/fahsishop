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

namespace PrestaShop\PrestaShop\Core\Domain\Meta\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Meta\Exception\MetaConstraintException;

/**
 * Class Name
 */
class Name
{
    /**
     * @var string
     */
    private $pageName;

    /**
     * @param string $pageName
     *
     * @throws MetaConstraintException
     */
    public function __construct($pageName)
    {
        $this->assertIsValidPageName($pageName);

        $this->pageName = $pageName;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     *
     * @throws MetaConstraintException
     */
    private function assertIsValidPageName($pageName)
    {
        if (!is_string($pageName) || !$pageName || !preg_match('/^[a-zA-Z0-9_.-]+$/', $pageName)) {
            throw new MetaConstraintException(sprintf('Invalid Meta page name %s', var_export($pageName, true)), MetaConstraintException::INVALID_PAGE_NAME);
        }
    }
}
