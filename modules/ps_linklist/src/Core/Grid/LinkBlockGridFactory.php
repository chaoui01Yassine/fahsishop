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

namespace PrestaShop\Module\LinkList\Core\Grid;

use PrestaShop\Module\LinkList\Core\Grid\Definition\Factory\LinkBlockDefinitionFactory;
use PrestaShop\Module\LinkList\Core\Search\Filters\LinkBlockFilters;
use PrestaShop\PrestaShop\Adapter\Shop\Context;
use PrestaShop\PrestaShop\Core\Grid\Data\Factory\GridDataFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\Filter\GridFilterFormFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\GridFactory;
use PrestaShop\PrestaShop\Core\Grid\GridInterface;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class LinkBlockGridFactory.
 */
final class LinkBlockGridFactory
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var HookDispatcherInterface
     */
    private $hookDispatcher;

    /**
     * @var GridDataFactoryInterface
     */
    private $dataFactory;

    /**
     * @var GridFilterFormFactoryInterface
     */
    private $filterFormFactory;

    /**
     * @var Context
     */
    private $shopContext;

    /**
     * HookGridFactory constructor.
     *
     * @param TranslatorInterface $translator
     * @param HookDispatcherInterface $hookDispatcher
     * @param GridDataFactoryInterface $dataFactory
     * @param GridFilterFormFactoryInterface $filterFormFactory
     * @param Context $shopContext
     */
    public function __construct(
        TranslatorInterface $translator,
        GridDataFactoryInterface $dataFactory,
        HookDispatcherInterface $hookDispatcher,
        GridFilterFormFactoryInterface $filterFormFactory,
        Context $shopContext
    ) {
        $this->translator = $translator;
        $this->hookDispatcher = $hookDispatcher;
        $this->dataFactory = $dataFactory;
        $this->filterFormFactory = $filterFormFactory;
        $this->shopContext = $shopContext;
    }

    /**
     * @param array $hooks
     * @param array $filtersParams
     *
     * @return GridInterface[]
     */
    public function getGrids(array $hooks, array $filtersParams)
    {
        $grids = [];
        foreach ($hooks as $hook) {
            $hookParams = $filtersParams;
            $hookParams['filters']['id_hook'] = $hook['id_hook'];
            $hookParams['filters']['id_shop'] = $this->shopContext->getContextListShopID();

            $filters = new LinkBlockFilters($hookParams);

            $gridFactory = $this->buildGridFactoryByHook($hook);
            $grids[] = $gridFactory->getGrid($filters);
        }

        return $grids;
    }

    /**
     * Each definition depends on the hook, therefore each factory also
     * depends on the hook.
     *
     * @param array $hook
     *
     * @return GridFactory
     */
    private function buildGridFactoryByHook(array $hook)
    {
        $definitionFactory = new LinkBlockDefinitionFactory($hook, $this->shopContext, $this->hookDispatcher);
        $definitionFactory->setTranslator($this->translator);

        return new GridFactory(
            $definitionFactory,
            $this->dataFactory,
            $this->filterFormFactory,
            $this->hookDispatcher
        );
    }
}
