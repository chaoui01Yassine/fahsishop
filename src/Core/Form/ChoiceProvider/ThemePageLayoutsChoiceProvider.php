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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\Addon\Theme\Theme;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class ThemePageLayoutsChoiceProvider proves page layout choices for given theme.
 */
final class ThemePageLayoutsChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var Theme
     */
    private $theme;

    /**
     * @param Theme $theme
     */
    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $choices = [];

        foreach ($this->theme->getAvailableLayouts() as $layoutId => $availableLayout) {
            $choices[sprintf('%s - %s', $availableLayout['name'], $availableLayout['description'])] = $layoutId;
        }

        return $choices;
    }
}
