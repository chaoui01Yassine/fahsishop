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

namespace PrestaShop\PrestaShop\Adapter\Webservice;

use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Manages the configuration data about upload quota options.
 */
final class WebserviceConfiguration extends AbstractMultistoreConfiguration
{
    private const CONFIGURATION_FIELDS = ['enable_webservice', 'enable_cgi'];

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        $shopConstraint = $this->getShopConstraint();

        return [
            'enable_webservice' => (bool) $this->configuration->get('PS_WEBSERVICE', false, $shopConstraint),
            'enable_cgi' => (bool) $this->configuration->get('PS_WEBSERVICE_CGI_HOST', false, $shopConstraint),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration)
    {
        if ($this->validateConfiguration($configuration)) {
            $shopConstraint = $this->getShopConstraint();
            $this->updateConfigurationValue('PS_WEBSERVICE', 'enable_webservice', $configuration, $shopConstraint);
            $this->updateConfigurationValue('PS_WEBSERVICE_CGI_HOST', 'enable_cgi', $configuration, $shopConstraint);
        }

        return [];
    }

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        $resolver = (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('enable_webservice', 'bool')
            ->setAllowedTypes('enable_cgi', 'bool');

        return $resolver;
    }
}
