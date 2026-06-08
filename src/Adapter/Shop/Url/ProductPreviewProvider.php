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

namespace PrestaShop\PrestaShop\Adapter\Shop\Url;

use Link;
use PrestaShop\PrestaShop\Core\Shop\Url\UrlProviderInterface;
use Tools;

class ProductPreviewProvider implements UrlProviderInterface
{
    /**
     * @var Link
     */
    protected $link;

    /**
     * @var int
     */
    protected $employeeId;

    /**
     * @var bool
     */
    private $urlRewritingIsEnabled;

    public function __construct(
        Link $link,
        bool $urlRewritingIsEnabled,
        int $employeeId
    ) {
        $this->link = $link;
        $this->employeeId = $employeeId;
        $this->urlRewritingIsEnabled = $urlRewritingIsEnabled;
    }

    /**
     * Create a link to a product.
     *
     * @param int|null $productId
     * @param bool $active
     * @param int|null $shopId
     *
     * @return string
     */
    public function getUrl(?int $productId = null, ?bool $active = true, ?int $shopId = null): string
    {
        $preview_url = $this->link->getProductLink(
            $productId,
            null,
            null,
            null,
            null,
            $shopId,
            null,
            $this->urlRewritingIsEnabled
        );

        if (!$active) {
            $token = Tools::getAdminTokenLite('AdminProducts');
            $preview_url = sprintf(
                '%s%sadtoken=%s&id_employee=%d&preview=1',
                $preview_url,
                ((strpos($preview_url, '?') === false) ? '?' : '&'),
                $token,
                $this->employeeId
            );
        }

        return $preview_url;
    }
}
