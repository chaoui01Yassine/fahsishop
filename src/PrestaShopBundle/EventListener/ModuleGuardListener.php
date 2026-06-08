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

namespace PrestaShopBundle\EventListener;

use PrestaShop\PrestaShop\Core\Exception\FileNotFoundException;
use PrestaShop\PrestaShop\Core\Exception\IOException;
use PrestaShop\PrestaShop\Core\Security\FolderGuardInterface;
use PrestaShopBundle\Event\ModuleManagementEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listen install/upgrade events from module manager, and protect the module vendor
 * folder using htaccess file.
 */
class ModuleGuardListener implements EventSubscriberInterface
{
    /**
     * @var FolderGuardInterface
     */
    private $vendorFolderGuard;

    /**
     * @var string
     */
    private $modulesDir;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param FolderGuardInterface $vendorFolderGuard
     * @param string $modulesDir
     * @param LoggerInterface $logger
     */
    public function __construct(
        FolderGuardInterface $vendorFolderGuard,
        $modulesDir,
        LoggerInterface $logger
    ) {
        $this->vendorFolderGuard = $vendorFolderGuard;
        $this->modulesDir = $modulesDir;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ModuleManagementEvent::INSTALL => 'protectModule',
            ModuleManagementEvent::UPGRADE => 'protectModule',
            ModuleManagementEvent::ENABLE => 'protectModule',
        ];
    }

    /**
     * @param ModuleManagementEvent $event
     */
    public function protectModule(ModuleManagementEvent $event)
    {
        $moduleName = $event->getModule()->get('name');
        $moduleVendorPath = $this->modulesDir . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'vendor';

        try {
            $this->logger->info(sprintf('Protect vendor folder in module %s', $moduleName));
            $this->vendorFolderGuard->protectFolder($moduleVendorPath);
        } catch (IOException $e) {
            $this->logger->error(sprintf('%s: %s', $e->getMessage(), $e->getPath()));
        } catch (FileNotFoundException $e) {
            $this->logger->info(sprintf('Module %s has no vendor folder', $moduleName));
        }
    }
}
