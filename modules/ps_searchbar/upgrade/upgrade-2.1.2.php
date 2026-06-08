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
if (!defined('_PS_VERSION_')) {
    exit;
}

// In the latest version fahsishop 1.7.8 the override for this module in classic theme was removed
// because the module is now self-sufficient, so we disable it from the theme to make sure the correct
// internal template is used (we only clean the theme from core classic theme, and only if it was not
// updated). Since this version of the module is only compatible starting PS 1.7.8 this clean can always
// be performed regardless of the current fahsishop version.
// We don't delete the file but rather rename it so that the merchant can perform a rollback in case important
// changes were present in the file

function upgrade_module_2_1_2($module)
{
    $module->unregisterHook('top');
    $module->registerHook('displayTop');
    $module->unregisterHook('header');
    $module->registerHook('displayHeader');

    if (defined('_PS_ROOT_DIR_')) {
        $coreThemeFile = realpath(_PS_ROOT_DIR_ . '/themes/classic/modules/ps_searchbar/ps_searchbar.tpl');
        if (file_exists($coreThemeFile)) {
            @rename($coreThemeFile, $coreThemeFile . '.bak');
        }
    }

    return true;
}
