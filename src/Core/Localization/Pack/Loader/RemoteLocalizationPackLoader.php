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

namespace PrestaShop\PrestaShop\Core\Localization\Pack\Loader;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Foundation\Version;

/**
 * Class RemoteLocalizationPackLoader is responsible for loading localization pack data from prestashop.com.
 */
final class RemoteLocalizationPackLoader extends AbstractLocalizationPackLoader
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @var Version
     */
    private $version;

    /**
     * @param ConfigurationInterface $configuration
     * @param Version $version
     */
    public function __construct(ConfigurationInterface $configuration, Version $version)
    {
        $this->configuration = $configuration;
        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalizationPackList()
    {
        $apiUrl = $this->configuration->get('_PS_API_URL_');

        $xmlLocalizationPacks = $this->loadXml($apiUrl . '/rss/localization.xml');
        if (!$xmlLocalizationPacks) {
            return null;
        }

        return $xmlLocalizationPacks;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalizationPack($countryIso)
    {
        $apiUrl = $this->configuration->get('_PS_API_URL_');
        $localizationPackUrl = sprintf('%s/localization/%s/%s.xml', $apiUrl, $this->version->getMajorVersion(), $countryIso);

        return $this->loadXml($localizationPackUrl);
    }
}
