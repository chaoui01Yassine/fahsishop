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

namespace PrestaShop\PrestaShop\Core\Domain\CreditSlip\Query;

use DateTime;

/**
 * Gets CreditSlipIds for provided date range
 */
final class GetCreditSlipIdsByDateRange
{
    /**
     * @var DateTime
     */
    private $dateTimeFrom;

    /**
     * @var DateTime
     */
    private $dateTimeTo;

    /**
     * @param DateTime $dateTimeFrom
     * @param DateTime $dateTimeTo
     */
    public function __construct(DateTime $dateTimeFrom, DateTime $dateTimeTo)
    {
        $this->dateTimeFrom = $dateTimeFrom;
        $this->dateTimeTo = $dateTimeTo;
    }

    /**
     * @return DateTime
     */
    public function getDateTimeFrom()
    {
        return $this->dateTimeFrom;
    }

    /**
     * @return DateTime
     */
    public function getDateTimeTo()
    {
        return $this->dateTimeTo;
    }
}
