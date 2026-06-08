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

namespace PrestaShop\PrestaShop\Core\Domain\Order\QueryResult;

use DateTimeImmutable;

class OrderDocumentForViewing
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * When eligible, document amount as a number
     *
     * @var float|null
     */
    private $numericalAmount;

    /**
     * When eligible, document amount as a string, ready to be displayed
     *
     * @var string|null
     */
    private $amount;

    /**
     * @var string|null
     */
    private $amountMismatch;

    /**
     * @var string
     */
    private $note;

    /**
     * @var bool
     */
    private $isAddPaymentAllowed;

    public function __construct(
        int $id,
        string $type,
        DateTimeImmutable $createdAt,
        string $referenceNumber,
        ?float $numericalAmount,
        ?string $amount,
        ?string $amountMismatch,
        ?string $note,
        bool $isAddPaymentAllowed
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->referenceNumber = $referenceNumber;
        $this->numericalAmount = $numericalAmount;
        $this->amount = $amount;
        $this->amountMismatch = $amountMismatch;
        $this->note = $note;
        $this->isAddPaymentAllowed = $isAddPaymentAllowed;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber;
    }

    /**
     * @return string|null
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function getAmountMismatch(): ?string
    {
        return $this->amountMismatch;
    }

    /**
     * @return string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @return bool
     */
    public function isAddPaymentAllowed(): bool
    {
        return $this->isAddPaymentAllowed;
    }

    /**
     * @return float|null
     */
    public function getNumericalAmount(): ?float
    {
        return $this->numericalAmount;
    }
}
