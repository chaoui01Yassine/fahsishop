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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Adapter\Shop\QueryHandler;

use PrestaShop\PrestaShop\Core\Domain\Shop\Query\SearchShops;
use PrestaShop\PrestaShop\Core\Domain\Shop\QueryHandler\SearchShopsHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Shop\QueryResult\FoundShop;
use PrestaShop\PrestaShop\Core\Domain\Shop\QueryResult\FoundShopGroup;
use PrestaShopBundle\Entity\Repository\ShopGroupRepository;
use PrestaShopBundle\Entity\Repository\ShopRepository;

/**
 * Responsible for getting shops for a given search term.
 */
final class SearchShopsHandler implements SearchShopsHandlerInterface
{
    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var ShopGroupRepository
     */
    private $shopGroupRepository;

    /**
     * SearchShopsHandler constructor.
     *
     * @param ShopRepository $shopRepository
     * @param ShopGroupRepository $shopGroupRepository
     */
    public function __construct(ShopRepository $shopRepository, ShopGroupRepository $shopGroupRepository)
    {
        $this->shopRepository = $shopRepository;
        $this->shopGroupRepository = $shopGroupRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(SearchShops $query): array
    {
        $searchTerm = $query->getSearchTerm();
        $shopGroupList = $this->shopGroupRepository->findBySearchTerm($searchTerm);
        $shopList = $this->shopRepository->findBySearchTerm($searchTerm);
        $result = [];

        foreach ($shopGroupList as $shopGroup) {
            if (!$shopGroup->getShops()->isEmpty()) {
                $result[] = new FoundShopGroup(
                    $shopGroup->getId(),
                    $shopGroup->getColor() ?? '',
                    $shopGroup->getName()
                );
            }
        }

        foreach ($shopList as $shop) {
            if (!$shop->hasMainUrl()) {
                continue;
            }

            $result[] = new FoundShop(
                $shop->getId(),
                $shop->getColor() ?? '',
                $shop->getName(),
                $shop->getShopGroup()->getId(),
                $shop->getShopGroup()->getName(),
                $shop->getShopGroup()->getColor()
            );
        }

        return $result;
    }
}
