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

/**
 * @param blockreassurance $module
 *
 * @return bool|string
 */
function upgrade_module_5_1_0($module)
{
    $sql = [];
    $sql[] = sprintf(
        'DELETE FROM `%spsreassurance_lang` WHERE `id_shop` != %d',
        _DB_PREFIX_,
        Configuration::get('PS_SHOP_DEFAULT')
    );
    $sql[] = sprintf(
        'ALTER TABLE `%spsreassurance_lang` DROP PRIMARY KEY, ADD PRIMARY KEY(`id_psreassurance`,`id_lang`);',
        _DB_PREFIX_
    );
    $sql[] = sprintf('ALTER TABLE `%spsreassurance` DROP `id_shop`;', _DB_PREFIX_);
    $sql[] = sprintf('ALTER TABLE `%spsreassurance_lang` DROP `id_shop`;', _DB_PREFIX_);

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) === false) {
            return Db::getInstance()->getMsgError();
        }
    }

    return true;
}
