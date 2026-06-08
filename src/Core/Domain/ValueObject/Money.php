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

namespace PrestaShop\PrestaShop\Core\Domain\ValueObject;

use PrestaShop\Decimal\DecimalNumber;
use PrestaShop\PrestaShop\Core\Domain\Currency\ValueObject\CurrencyId;
use PrestaShop\PrestaShop\Core\Domain\Exception\DomainConstraintException;

/**
 * An amount of money with currency
 */
class Money
{
    /**
     * @var DecimalNumber
     */
    private $amount;

    /**
     * @var CurrencyId
     */
    private $currencyId;

    /**
     * @param DecimalNumber $amount
     * @param CurrencyId $currencyId
     *
     * @throws DomainConstraintException
     */
    public function __construct(DecimalNumber $amount, CurrencyId $currencyId)
    {
        if (!$amount->isGreaterOrEqualThanZero()) {
            throw new DomainConstraintException(sprintf('Money amount cannot be lower than zero, %f given', (string) $amount), DomainConstraintException::INVALID_MONEY_AMOUNT);
        }

        $this->amount = $amount;
        $this->currencyId = $currencyId;
    }

    /**
     * @return DecimalNumber
     */
    public function getAmount(): DecimalNumber
    {
        return $this->amount;
    }

    /**
     * @return CurrencyId
     */
    public function getCurrencyId(): CurrencyId
    {
        return $this->currencyId;
    }
}
