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
class PdfOrderSlipControllerCore extends FrontController
{
    /** @var string */
    public $php_self = 'pdf-order-slip';
    /** @var bool */
    protected $display_header = false;
    /** @var bool */
    protected $display_footer = false;

    protected $order_slip;

    public function postProcess()
    {
        if (!$this->context->customer->isLogged()) {
            Tools::redirect('index.php?controller=authentication&back=order-follow');
        }

        if (isset($_GET['id_order_slip']) && Validate::isUnsignedId($_GET['id_order_slip'])) {
            $this->order_slip = new OrderSlip($_GET['id_order_slip']);
        }

        if (!isset($this->order_slip) || !Validate::isLoadedObject($this->order_slip)) {
            die($this->trans('Order return not found.', [], 'Shop.Notifications.Error'));
        } elseif ($this->order_slip->id_customer != $this->context->customer->id) {
            die($this->trans('Order return not found.', [], 'Shop.Notifications.Error'));
        }
    }

    /**
     * @return bool|void
     *
     * @throws PrestaShopException
     */
    public function display()
    {
        $pdf = new PDF($this->order_slip, PDF::TEMPLATE_ORDER_SLIP, $this->context->smarty);
        $pdf->render();
    }
}
