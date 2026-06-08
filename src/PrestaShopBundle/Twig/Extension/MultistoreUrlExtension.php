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

namespace PrestaShopBundle\Twig\Extension;

use PrestaShopBundle\Entity\Shop;
use PrestaShopBundle\Entity\ShopGroup;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class MultiStoreUrlExtension is responsible for providing a way to generate url with setShopContext parameter.
 */
class MultistoreUrlExtension extends AbstractExtension
{
    public const SHOP_CONTEXT_PARAMETER = 'setShopContext';

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('multistore_url', [$this, 'generateUrl']),
            new TwigFunction('multistore_group_url', [$this, 'generateGroupUrl']),
            new TwigFunction('multistore_shop_url', [$this, 'generateShopUrl']),
        ];
    }

    /**
     * Generate URL from current request for a specific shop group.
     *
     * @param int|null $id
     * @param string|null $prefix
     *
     * @return string
     */
    public function generateUrl(?int $id = null, ?string $prefix = null): string
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        $currentRequest->query->set(
            static::SHOP_CONTEXT_PARAMETER,
            $prefix . $id
        );

        return $currentRequest->getBaseUrl()
            . $currentRequest->getPathInfo()
            . '?'
            . http_build_query($currentRequest->query->all());
    }

    /**
     * Generate URL from current request for a specific shop group.
     *
     * @param ShopGroup $group
     *
     * @return string
     */
    public function generateGroupUrl(ShopGroup $group): string
    {
        return $this->generateUrl($group->getId(), 'g-');
    }

    /**
     * Generate URL from current request for a specific shop.
     *
     * @param Shop $shop
     *
     * @return string
     */
    public function generateShopUrl(Shop $shop = null): string
    {
        return $this->generateUrl($shop->getId(), 's-');
    }
}
