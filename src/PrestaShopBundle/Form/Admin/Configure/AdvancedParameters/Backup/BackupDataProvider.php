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

namespace PrestaShopBundle\Form\Admin\Configure\AdvancedParameters\Backup;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

/**
 * Class BackupDataProvider provides backup options form data.
 */
final class BackupDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $backupOptionsConfigurator;

    /**
     * @param DataConfigurationInterface $backupOptionsConfigurator
     */
    public function __construct(DataConfigurationInterface $backupOptionsConfigurator)
    {
        $this->backupOptionsConfigurator = $backupOptionsConfigurator;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->backupOptionsConfigurator->getConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        return $this->backupOptionsConfigurator->updateConfiguration($data);
    }
}
