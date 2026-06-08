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

namespace PrestaShopBundle\Form\Admin\Improve\International\Geolocation;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;
use PrestaShop\PrestaShop\Core\Geolocation\GeoLite\GeoLiteCityCheckerInterface;

/**
 * Class GeolocationByIpAddressFormDataProvider is responsible for handling geolocation form data.
 */
final class GeolocationByIpAddressFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $dataConfiguration;

    /**
     * @var GeoLiteCityCheckerInterface
     */
    private $geoLiteCityChecker;

    /**
     * @param DataConfigurationInterface $dataConfiguration
     * @param GeoLiteCityCheckerInterface $geoLiteCityChecker
     */
    public function __construct(
        DataConfigurationInterface $dataConfiguration,
        GeoLiteCityCheckerInterface $geoLiteCityChecker
    ) {
        $this->dataConfiguration = $dataConfiguration;
        $this->geoLiteCityChecker = $geoLiteCityChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->dataConfiguration->getConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        $errors = [];

        if ($data['geolocation_enabled'] && !$this->geoLiteCityChecker->isAvailable()) {
            $errors[] = [
                'key' => 'The geolocation database is unavailable.',
                'parameters' => [],
                'domain' => 'Admin.International.Notification',
            ];
        }

        if (!empty($errors)) {
            return $errors;
        }

        return $this->dataConfiguration->updateConfiguration($data);
    }
}
