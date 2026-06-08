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

namespace PrestaShop\PrestaShop\Adapter\Shop\Repository;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Domain\Shop\Exception\ShopNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopId;
use PrestaShop\PrestaShop\Core\Repository\AbstractObjectModelRepository;
use Shop;

/**
 * Provides methods to access data storage for shop
 */
class ShopRepository extends AbstractObjectModelRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $dbPrefix;

    public function __construct(
        Connection $connection,
        string $dbPrefix
    ) {
        $this->connection = $connection;
        $this->dbPrefix = $dbPrefix;
    }

    /**
     * @param ShopId $shopId
     *
     * @return Shop
     *
     * @throws ShopNotFoundException
     */
    public function get(ShopId $shopId): Shop
    {
        /** @var Shop $shop */
        $shop = $this->getObjectModel(
            $shopId->getValue(),
            Shop::class,
            ShopNotFoundException::class
        );

        return $shop;
    }

    public function getShopName(ShopId $shopId): string
    {
        $result = $this
            ->connection
            ->createQueryBuilder()
            ->select('s.name')
            ->from($this->dbPrefix . 'shop', 's')
            ->where('s.id_shop = :shopId')
            ->setParameter('shopId', $shopId->getValue())
            ->execute()
            ->fetchAssociative()
        ;

        if (empty($result['name'])) {
            throw new ShopNotFoundException(sprintf('%s #%d was not found', Shop::class, $shopId->getValue()));
        }

        return $result['name'];
    }

    /**
     * @param ShopId $shopId
     *
     * @throws ShopNotFoundException
     */
    public function assertShopExists(ShopId $shopId): void
    {
        parent::assertObjectModelExists(
            $shopId->getValue(),
            'shop',
            ShopNotFoundException::class
        );
    }
}
