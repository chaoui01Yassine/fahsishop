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

namespace PrestaShopBundle\DependencyInjection\Compiler;

use PrestaShop\PrestaShop\Adapter\Module\Repository\ModuleRepository;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Load services stored in installed modules.
 */
class LoadServicesFromModulesPass implements CompilerPassInterface
{
    /**
     * @var string
     */
    private $configPath;

    /**
     * @var array
     */
    private $activeModulesPaths;

    /**
     * Used to identify which scope of services need to be loaded (front services, admin
     * services or generic ones)
     *
     * @param string $containerName
     */
    public function __construct($containerName = '')
    {
        $this->configPath = '/config/' . (empty($containerName) ? '' : trim($containerName, '/') . '/');
        $this->activeModulesPaths = (new ModuleRepository(_PS_ROOT_DIR_, _PS_MODULE_DIR_))->getActiveModulesPaths();
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (empty($this->activeModulesPaths)) {
            return;
        }

        foreach ($this->activeModulesPaths as $modulePath) {
            $moduleConfigPath = $modulePath . $this->configPath;
            if (file_exists($moduleConfigPath . 'services.yml')) {
                $fileLocator = new FileLocator($moduleConfigPath);
                $loader = new YamlFileLoader($container, $fileLocator);
                $loader->setResolver(new LoaderResolver([
                    new PhpFileLoader($container, $fileLocator),
                    new XmlFileLoader($container, $fileLocator),
                ]));
                $loader->load('services.yml');
            }
        }
    }
}
