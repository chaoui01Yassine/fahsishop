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

namespace PrestaShop\PrestaShop\Core\Domain\Theme\CommandHandler;

use PrestaShop\PrestaShop\Core\Addon\Theme\ThemeManager;
use PrestaShop\PrestaShop\Core\Domain\Theme\Command\DeleteThemeCommand;
use PrestaShop\PrestaShop\Core\Domain\Theme\Exception\CannotDeleteThemeException;

/**
 * Class DeleteThemeHandler
 */
final class DeleteThemeHandler implements DeleteThemeHandlerInterface
{
    /**
     * @var ThemeManager
     */
    private $themeManager;

    /**
     * @param ThemeManager $themeManager
     */
    public function __construct(ThemeManager $themeManager)
    {
        $this->themeManager = $themeManager;
    }

    /**
     * @param DeleteThemeCommand $command
     */
    public function handle(DeleteThemeCommand $command)
    {
        $plainThemeName = $command->getThemeName()->getValue();

        if (!$this->themeManager->uninstall($plainThemeName)) {
            throw new CannotDeleteThemeException(sprintf('Theme "%s" is used and thus cannot be deleted.', $plainThemeName));
        }
    }
}
