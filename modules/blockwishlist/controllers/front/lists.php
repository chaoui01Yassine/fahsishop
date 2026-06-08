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
class BlockWishlistListsModuleFrontController extends ModuleFrontController
{
    /**
     * @var bool If set to true, will be redirected to authentication page
     */
    public $auth = true;

    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign(
        [
            'url' => $this->context->link->getModuleLink('blockwishlist', 'action', ['action' => 'getAllWishlist']),
            'renameUrl' => $this->context->link->getModuleLink('blockwishlist', 'action', ['action' => 'renameWishlist']),
            'shareUrl' => $this->context->link->getModuleLink('blockwishlist', 'action', ['action' => 'getUrlByIdWishlist']),
            'accountLink' => '#',
            'wishlistsTitlePage' => Configuration::get('blockwishlist_WishlistPageName', $this->context->language->id),
            'newWishlistCTA' => Configuration::get('blockwishlist_CreateButtonLabel', $this->context->language->id),
        ]
      );

        $this->context->controller->registerJavascript(
          'blockwishlistController',
          'modules/blockwishlist/public/wishlistcontainer.bundle.js',
          [
            'priority' => 200,
          ]
      );

        $this->setTemplate('module:blockwishlist/views/templates/pages/lists.tpl');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = $this->addMyAccountToBreadcrumb();
        $breadcrumb['links'][] = [
          'title' => Configuration::get('blockwishlist_WishlistPageName', $this->context->language->id),
          'url' => $this->context->link->getModuleLink('blockwishlist', 'lists'),
        ];

        return $breadcrumb;
    }
}
