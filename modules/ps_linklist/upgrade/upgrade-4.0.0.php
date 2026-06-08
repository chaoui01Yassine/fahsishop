<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_4_0_0($object)
{
    $result = true;
    $result &= Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'tab` SET `route_name` = "admin_link_block_list" WHERE `class_name` = "AdminLinkWidget"');
    $result &= Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'link_block` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');
    $result &= Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'link_block_lang` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');
    $result &= Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'link_block_shop` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');

    return (bool) $result;
}
