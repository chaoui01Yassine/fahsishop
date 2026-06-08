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

namespace PrestaShopBundle\Twig\Extension;

use PrestaShop\PrestaShop\Core\Util\ColorBrightnessCalculator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds color calculation functions to Twig.
 */
class ColorBrightnessCalculatorExtension extends AbstractExtension
{
    /**
     * @var ColorBrightnessCalculator
     */
    private $brightnessCalculator;

    /**
     * @param ColorBrightnessCalculator $brightnessCalculator
     */
    public function __construct(ColorBrightnessCalculator $brightnessCalculator)
    {
        $this->brightnessCalculator = $brightnessCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'is_color_bright',
                [$this->brightnessCalculator, 'isBright']
            ),
        ];
    }
}
