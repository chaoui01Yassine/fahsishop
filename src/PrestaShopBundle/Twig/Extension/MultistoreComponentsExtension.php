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

use PrestaShopBundle\Controller\Admin\MultistoreController;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class MultistoreComponentsExtension provides helper function to get the multistore components' html in a template
 */
class MultistoreComponentsExtension extends AbstractExtension
{
    /**
     * @var MultistoreController
     */
    private $multistoreController;

    /**
     * MultistoreHeaderExtension constructor.
     *
     * @param MultistoreController $multistoreController
     */
    public function __construct(MultistoreController $multistoreController)
    {
        $this->multistoreController = $multistoreController;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('multistoreHeader', [$this, 'getMultistoreHeader'], ['is_safe' => ['html']]),
            new TwigFunction('multistoreProductHeader', [$this, 'getMultistoreProductHeader'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param bool $lockedToAllShopContext
     *
     * @return string
     */
    public function getMultistoreHeader(bool $lockedToAllShopContext = false): string
    {
        return $this->multistoreController->header($lockedToAllShopContext)->getContent();
    }

    /**
     * @param int $productId
     *
     * @return string
     */
    public function getMultistoreProductHeader(int $productId): string
    {
        return $this->multistoreController->productHeader($productId)->getContent();
    }
}
