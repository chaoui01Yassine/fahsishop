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

namespace PrestaShop\PrestaShop\Adapter\Hook\CommandHandler;

use Hook;
use PrestaShop\PrestaShop\Core\Domain\Hook\Command\UpdateHookStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\Hook\CommandHandler\UpdateHookStatusCommandHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Hook\Exception\CannotUpdateHookException;
use PrestaShop\PrestaShop\Core\Domain\Hook\Exception\HookNotFoundException;

/**
 * @internal
 */
class UpdateHookStatusCommandHandler implements UpdateHookStatusCommandHandlerInterface
{
    /**
     * @param UpdateHookStatusCommand $command
     */
    public function handle(UpdateHookStatusCommand $command)
    {
        $hookId = $command->getHookId()->getValue();
        $hook = new Hook($hookId);

        if ($hook->id !== $hookId) {
            throw new HookNotFoundException(sprintf('Hook with id "%d" was not found', $hookId));
        }

        $hook->active = !$command->getStatus();
        if (!$hook->save()) {
            throw new CannotUpdateHookException(sprintf('Cannot update status for hook with id "%d"', $hookId));
        }
    }
}
