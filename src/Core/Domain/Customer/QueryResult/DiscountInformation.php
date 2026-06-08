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

namespace PrestaShop\PrestaShop\Core\Domain\Customer\QueryResult;

/**
 * Class DiscountInformation.
 */
class DiscountInformation
{
    /**
     * @var int
     */
    private $discountId;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var int
     */
    private $availableQuantity;

    /**
     * @param int $discountId
     * @param string $code
     * @param string $name
     * @param bool $isActive
     * @param int $availableQuantity
     */
    public function __construct(
        $discountId,
        $code,
        $name,
        $isActive,
        $availableQuantity
    ) {
        $this->discountId = $discountId;
        $this->code = $code;
        $this->name = $name;
        $this->isActive = $isActive;
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * @return int
     */
    public function getDiscountId()
    {
        return $this->discountId;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @return int
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }
}
