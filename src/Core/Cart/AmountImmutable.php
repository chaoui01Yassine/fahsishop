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

namespace PrestaShop\PrestaShop\Core\Cart;

/**
 * provide objects dealing with tax ex/in-cluded amounts
 * aims to avoid using multiple values into calculation processes.
 *
 * this class is IMMUTABLE
 */
class AmountImmutable
{
    /**
     * @var float
     */
    protected $taxIncluded = 0.0;

    /**
     * @var float
     */
    protected $taxExcluded = 0.0;

    public function __construct($taxIncluded = 0.0, $taxExcluded = 0.0)
    {
        $this->setTaxIncluded($taxIncluded);
        $this->setTaxExcluded($taxExcluded);
    }

    /**
     * @return float
     */
    public function getTaxIncluded()
    {
        return $this->taxIncluded;
    }

    /**
     * @param float $taxIncluded
     *
     * @return AmountImmutable
     */
    protected function setTaxIncluded($taxIncluded)
    {
        $this->taxIncluded = (float) $taxIncluded;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxExcluded()
    {
        return $this->taxExcluded;
    }

    /**
     * @param float $taxExcluded
     *
     * @return AmountImmutable
     */
    protected function setTaxExcluded($taxExcluded)
    {
        $this->taxExcluded = (float) $taxExcluded;

        return $this;
    }

    /**
     * Sums another amount object.
     *
     * @param AmountImmutable $amount
     *
     * @return AmountImmutable
     */
    public function add(AmountImmutable $amount)
    {
        return new static(
            $this->getTaxIncluded() + $amount->getTaxIncluded(),
            $this->getTaxExcluded() + $amount->getTaxExcluded()
        );
    }

    /**
     * Substract another amount object.
     *
     * @param AmountImmutable $amount
     *
     * @return AmountImmutable
     */
    public function sub(AmountImmutable $amount)
    {
        return new static(
            $this->getTaxIncluded() - $amount->getTaxIncluded(),
        $this->getTaxExcluded() - $amount->getTaxExcluded()
        );
    }
}
