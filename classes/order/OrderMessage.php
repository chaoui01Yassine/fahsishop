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
class OrderMessageCore extends ObjectModel
{
    /** @var string|array<int, string> Name */
    public $name;

    /** @var string|array<int, string> Message content */
    public $message;

    /** @var string Object creation date */
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'order_message',
        'primary' => 'id_order_message',
        'multilang' => true,
        'fields' => [
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            /* Lang fields */
            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 128],
            'message' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isMessage', 'required' => true, 'size' => 4194303],
        ],
    ];

    protected $webserviceParameters = [
        'fields' => [
            'id' => ['sqlId' => 'id_discount_type', 'xlink_resource' => 'order_message_lang'],
            'date_add' => ['sqlId' => 'date_add'],
        ],
    ];

    public static function getOrderMessages($id_lang)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
        SELECT om.id_order_message, oml.name, oml.message
        FROM ' . _DB_PREFIX_ . 'order_message om
        LEFT JOIN ' . _DB_PREFIX_ . 'order_message_lang oml ON (oml.id_order_message = om.id_order_message)
        WHERE oml.id_lang = ' . (int) $id_lang . '
        ORDER BY name ASC');
    }
}
