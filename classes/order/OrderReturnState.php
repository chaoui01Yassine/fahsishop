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
class OrderReturnStateCore extends ObjectModel
{
    /** @var string|array<int, string> Name */
    public $name;

    /** @var string Display state in the specified color */
    public $color;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'order_return_state',
        'primary' => 'id_order_return_state',
        'multilang' => true,
        'fields' => [
            'color' => ['type' => self::TYPE_STRING, 'validate' => 'isColor'],

            /* Lang fields */
            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 64],
        ],
    ];

    /**
     * Get all available order statuses.
     *
     * @param int $id_lang Language id for status name
     *
     * @return array Order statuses
     */
    public static function getOrderReturnStates($id_lang)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
        SELECT *
        FROM `' . _DB_PREFIX_ . 'order_return_state` ors
        LEFT JOIN `' . _DB_PREFIX_ . 'order_return_state_lang` orsl ON (ors.`id_order_return_state` = orsl.`id_order_return_state` AND orsl.`id_lang` = ' . (int) $id_lang . ')
        ORDER BY ors.`id_order_return_state` ASC');
    }
}
