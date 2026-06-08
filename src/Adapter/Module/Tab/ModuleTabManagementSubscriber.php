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

namespace PrestaShop\PrestaShop\Adapter\Module\Tab;

use PrestaShopBundle\Event\ModuleManagementEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This class subscribes to the events module installation / uninstallation
 * in order to install or remove its tabs as well.
 */
class ModuleTabManagementSubscriber implements EventSubscriberInterface
{
    /**
     * @var ModuleTabRegister
     */
    private $moduleTabRegister;
    /**
     * @var ModuleTabUnregister
     */
    private $moduleTabUnregister;

    public function __construct(ModuleTabRegister $moduleTabRegister, ModuleTabUnregister $moduleTabUnregister)
    {
        $this->moduleTabRegister = $moduleTabRegister;
        $this->moduleTabUnregister = $moduleTabUnregister;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ModuleManagementEvent::INSTALL => 'onModuleInstall',
            ModuleManagementEvent::UNINSTALL => 'onModuleUninstall',
            ModuleManagementEvent::ENABLE => 'onModuleEnable',
            ModuleManagementEvent::DISABLE => 'onModuleDisable',
        ];
    }

    /**
     * @param ModuleManagementEvent $event
     */
    public function onModuleInstall(ModuleManagementEvent $event)
    {
        $this->moduleTabRegister->registerTabs($event->getModule());
    }

    /**
     * @param ModuleManagementEvent $event
     */
    public function onModuleUninstall(ModuleManagementEvent $event)
    {
        $this->moduleTabUnregister->unregisterTabs($event->getModule());
    }

    /**
     * @param ModuleManagementEvent $event
     */
    public function onModuleEnable(ModuleManagementEvent $event)
    {
        $this->moduleTabRegister->enableTabs($event->getModule());
    }

    /**
     * @param ModuleManagementEvent $event
     */
    public function onModuleDisable(ModuleManagementEvent $event)
    {
        $this->moduleTabUnregister->disableTabs($event->getModule());
    }
}
