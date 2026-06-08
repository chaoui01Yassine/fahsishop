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

namespace PrestaShop\PrestaShop\Adapter\Theme;

use Configuration;
use PrestaShop\PrestaShop\Core\Form\MultiStoreSettingsFormDataProviderInterface;

/**
 * This class is used to retrieve data which is used in settings form to render multi store fields - its used in
 * Theme & logo page.
 *
 * @internal
 */
final class ThemeMultiStoreSettingsFormDataProvider implements MultiStoreSettingsFormDataProviderInterface
{
    /**
     * @var bool
     */
    private $isShopFeatureUsed;

    /**
     * @var bool
     */
    private $isSingleShopContext;

    /**
     * @param bool $isShopFeatureUsed
     * @param bool $isSingleShopContext
     */
    public function __construct(
        $isShopFeatureUsed,
        $isSingleShopContext
    ) {
        $this->isShopFeatureUsed = $isShopFeatureUsed;
        $this->isSingleShopContext = $isSingleShopContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $isValidShopRestriction = $this->isShopFeatureUsed && $this->isSingleShopContext;

        $isHeaderLogoRestricted = $this->doesConfigurationExistInSingleShopContext('PS_LOGO');
        $isMailRestricted = $this->doesConfigurationExistInSingleShopContext('PS_LOGO_MAIL');
        $isInvoiceLogoRestricted = $this->doesConfigurationExistInSingleShopContext('PS_LOGO_INVOICE');
        $isFaviconRestricted = $this->doesConfigurationExistInSingleShopContext('PS_FAVICON');

        return [
            'header_logo_is_restricted_to_shop' => $isValidShopRestriction && $isHeaderLogoRestricted,
            'mail_logo_is_restricted_to_shop' => $isValidShopRestriction && $isMailRestricted,
            'invoice_logo_is_restricted_to_shop' => $isValidShopRestriction && $isInvoiceLogoRestricted,
            'favicon_is_restricted_to_shop' => $isValidShopRestriction && $isFaviconRestricted,
        ];
    }

    /**
     * Checks if the configuration exists for specific shop context.
     *
     * @param string $configurationKey
     *
     * @return bool
     */
    private function doesConfigurationExistInSingleShopContext($configurationKey)
    {
        return Configuration::isOverridenByCurrentContext($configurationKey);
    }
}
