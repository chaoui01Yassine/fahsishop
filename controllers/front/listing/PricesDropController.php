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
use PrestaShop\PrestaShop\Adapter\PricesDrop\PricesDropProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class PricesDropControllerCore extends ProductListingFrontController
{
    /** @var string */
    public $php_self = 'prices-drop';

    public function getCanonicalURL(): string
    {
        return $this->buildPaginatedUrl($this->context->link->getPageLink('prices-drop'));
    }

    /**
     * {@inheritdoc}
     */
    public function initContent()
    {
        parent::initContent();

        $this->doProductSearch('catalog/listing/prices-drop', ['entity' => 'prices-drop']);
    }

    /**
     * @return ProductSearchQuery
     */
    protected function getProductSearchQuery()
    {
        $query = new ProductSearchQuery();
        $query
            ->setQueryType('prices-drop')
            ->setSortOrder(new SortOrder('product', 'name', 'asc'));

        return $query;
    }

    /**
     * @return PricesDropProductSearchProvider
     */
    protected function getDefaultProductSearchProvider()
    {
        return new PricesDropProductSearchProvider(
            $this->getTranslator()
        );
    }

    public function getListingLabel()
    {
        return $this->trans(
            'Prices drop',
            [],
            'Shop.Theme.Catalog'
        );
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = [
            'title' => $this->trans('Prices drop', [], 'Shop.Theme.Catalog'),
            'url' => $this->context->link->getPageLink('prices-drop'),
        ];

        return $breadcrumb;
    }
}
