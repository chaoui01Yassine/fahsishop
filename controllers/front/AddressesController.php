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
class AddressesControllerCore extends FrontController
{
    /** @var bool */
    public $auth = true;
    /** @var string */
    public $php_self = 'addresses';
    /** @var string */
    public $authRedirection = 'addresses';
    /** @var bool */
    public $ssl = true;

    /**
     * Initialize addresses controller.
     *
     * @see FrontController::init()
     */
    public function init()
    {
        parent::init();

        if (!Validate::isLoadedObject($this->context->customer)) {
            die(Tools::displayError($this->trans('The customer could not be found.', [], 'Shop.Notifications.Error')));
        }
    }

    /**
     * Assign template vars related to page content.
     *
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('customer/addresses');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = $this->addMyAccountToBreadcrumb();

        $breadcrumb['links'][] = [
            'title' => $this->trans('Addresses', [], 'Shop.Theme.Global'),
            'url' => $this->context->link->getPageLink('addresses'),
        ];

        return $breadcrumb;
    }
}
