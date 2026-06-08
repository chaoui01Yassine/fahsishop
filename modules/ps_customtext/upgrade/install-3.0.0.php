<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrade the Ps_Customtext module to V3.0.0
 *
 * @param Ps_Customtext $module
 *
 * @return bool
 */
function upgrade_module_3_0_0($module)
{
    require_once _PS_MODULE_DIR_ . $module->name . '/classes/MigrateData.php';
    $migration = new MigrateData();

    $return = true;

    $migration->retrieveOldData();
    $return &= $module->uninstallDB();

    /* Register the hook responsible for adding custom text when adding a new store */
    $return &= $module->registerHook('actionShopDataDuplication');

    $return &= $module->installDB();

    /* Reset DB data */
    $return &= $migration->insertData();

    return (bool) $return;
}
