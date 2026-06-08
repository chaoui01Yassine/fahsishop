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

namespace PrestaShopBundle\Twig\Locator;

use Twig\Loader\FilesystemLoader;

/**
 * Loads templates from fahsishop modules.
 */
class ModuleTemplateLoader extends FilesystemLoader
{
    /**
     * @param array $namespaces a collection of path namespaces with namespace names
     * @param array $modulePaths A path or an array of paths where to look for module templates
     */
    public function __construct(array $namespaces, array $modulePaths = [])
    {
        if (!empty($modulePaths)) {
            $this->registerNamespacesFromConfig($modulePaths, $namespaces);
        }
    }

    /**
     * Register namespaces in module and link them to the right paths.
     *
     * @param array $modulePaths
     * @param array $namespaces
     */
    private function registerNamespacesFromConfig(array $modulePaths, array $namespaces)
    {
        foreach ($namespaces as $namespace => $namespacePath) {
            $templatePaths = [];

            foreach ($modulePaths as $path) {
                if (is_dir($dir = $path . '/views/fahsishop/' . $namespacePath)) {
                    $templatePaths[] = $dir;
                }
            }
            $this->setPaths($templatePaths, $namespace);
        }
    }
}
