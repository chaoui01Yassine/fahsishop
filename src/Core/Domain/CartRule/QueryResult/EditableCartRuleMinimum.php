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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\CartRule\QueryResult;

use PrestaShop\Decimal\DecimalNumber;
use PrestaShop\PrestaShop\Core\Domain\Currency\ValueObject\CurrencyId;

class EditableCartRuleMinimum
{
    /**
     * @var DecimalNumber
     */
    private $amount;

    /**
     * @var bool
     */
    private $amountTax;

    /**
     * @var CurrencyId
     */
    private $currencyId;

    /**
     * @var bool
     */
    private $shipping;

    public function __construct(
        DecimalNumber $amount,
        bool $amountTax,
        CurrencyId $currencyId,
        bool $shipping
    ) {
        $this->amount = $amount;
        $this->amountTax = $amountTax;
        $this->currencyId = $currencyId;
        $this->shipping = $shipping;
    }

    /**
     * @return DecimalNumber
     */
    public function getAmount(): DecimalNumber
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isAmountTax(): bool
    {
        return $this->amountTax;
    }

    /**
     * @return CurrencyId
     */
    public function getCurrencyId(): CurrencyId
    {
        return $this->currencyId;
    }

    /**
     * @return bool
     */
    public function isShipping(): bool
    {
        return $this->shipping;
    }
}
