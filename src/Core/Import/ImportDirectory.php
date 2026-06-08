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

namespace PrestaShop\PrestaShop\Core\Import;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * ImportDirectory class is responsible for returning import directory & data related to it.
 */
final class ImportDirectory
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Get path to import directory.
     *
     * @return string
     */
    public function getDir()
    {
        return $this->configuration->get('_PS_ADMIN_DIR_') . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;
    }

    /**
     * Check if import directory exists.
     *
     * @return bool
     */
    public function exists()
    {
        return (new Filesystem())->exists($this->getDir());
    }

    /**
     * Check if import directory is writable.
     *
     * @return bool
     */
    public function isWritable()
    {
        return is_writable($this->getDir());
    }

    /**
     * Check if import directory is readable.
     *
     * @return bool
     */
    public function isReadable()
    {
        return is_readable($this->getDir());
    }

    /**
     * Use import directory object as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getDir();
    }
}
