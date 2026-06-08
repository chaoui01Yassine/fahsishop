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

/**
 * @since 1.5.0
 */
abstract class StockManagerModuleCore extends Module
{
    public $stock_manager_class;

    public function install()
    {
        return parent::install() && $this->registerHook('stockManager');
    }

    public function hookStockManager()
    {
        $class_file = _PS_MODULE_DIR_ . '/' . $this->name . '/' . $this->stock_manager_class . '.php';

        if (!isset($this->stock_manager_class) || !file_exists($class_file)) {
            die($this->trans('Incorrect Stock Manager class [%s]', [$this->stock_manager_class], 'Admin.Catalog.Notification'));
        }

        require_once $class_file;

        if (!class_exists($this->stock_manager_class)) {
            die($this->trans('Stock Manager class not found [%s]', [$this->stock_manager_class], 'Admin.Catalog.Notification'));
        }

        $class = $this->stock_manager_class;
        if (call_user_func([$class, 'isAvailable'])) {
            return new $class();
        }

        return false;
    }
}
