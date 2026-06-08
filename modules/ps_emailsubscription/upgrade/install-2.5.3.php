<?php
/**
 * 2007-2020 fahsishop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to https://fahsishop.com for more information.
 *
 * @author    fahsishop <contact@fahsishop.com>
 * @copyright 2007-2020 fahsishop
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of fahsishop
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_2_5_3($object)
{
    return $object->registerHook('actionCustomerAccountUpdate')
        && $object->registerHook('actionObjectCustomerUpdateBefore');
}
