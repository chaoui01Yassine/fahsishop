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

namespace PrestaShop\PrestaShop\Core\Domain\State\Exception;

use PrestaShop\PrestaShop\Core\Domain\State\ValueObject\StateId;
use PrestaShop\PrestaShop\Core\Domain\State\ValueObject\StateIdInterface;
use Throwable;

/**
 * Is raised when state or states cannot be deleted
 */
class DeleteStateException extends StateException
{
    /**
     * When fails to delete single state
     */
    public const FAILED_DELETE = 1;

    /**
     * When fails to delete states in bulk actions
     */
    public const FAILED_BULK_DELETE = 2;

    /**
     * @param StateIdInterface $stateId
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function createDeleteFailure(StateIdInterface $stateId, Throwable $previous = null): self
    {
        return new static(
            sprintf('Cannot delete state with id "%d"', $stateId->getValue()),
            static::FAILED_DELETE,
            $previous
        );
    }

    /**
     * @param StateId $stateId
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function createBulkDeleteFailure(StateId $stateId, Throwable $previous = null): self
    {
        return new static(
            sprintf('An error occurred when deleting state with id "%d"', $stateId->getValue()),
            static::FAILED_BULK_DELETE,
            $previous
        );
    }
}
