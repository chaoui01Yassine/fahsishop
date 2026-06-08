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
class OrderCartRuleCore extends ObjectModel
{
    /** @var int */
    public $id_order_cart_rule;

    /** @var int */
    public $id_order;

    /** @var int */
    public $id_cart_rule;

    /** @var int */
    public $id_order_invoice;

    /** @var string */
    public $name;

    /** @var float value (tax incl.) of voucher */
    public $value;

    /** @var float value (tax excl.) of voucher */
    public $value_tax_excl;

    /** @var bool value : voucher gives free shipping or not */
    public $free_shipping;

    /** @var bool value : deleted from order */
    public $deleted = false;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'order_cart_rule',
        'primary' => 'id_order_cart_rule',
        'fields' => [
            'id_order' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'id_cart_rule' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'id_order_invoice' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'name' => ['type' => self::TYPE_HTML, 'required' => true],
            'value' => ['type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'required' => true],
            'value_tax_excl' => ['type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'required' => true],
            'free_shipping' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'deleted' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
        ],
    ];

    protected $webserviceParameters = [
        'fields' => [
            'id_order' => ['xlink_resource' => 'orders'],
        ],
    ];
}
