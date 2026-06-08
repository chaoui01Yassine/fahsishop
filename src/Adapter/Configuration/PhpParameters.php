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

namespace PrestaShop\PrestaShop\Adapter\Configuration;

use InvalidArgumentException;
use PrestaShop\PrestaShop\Core\Util\ArrayFinder;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class able to manage configuration stored in Php files.
 */
class PhpParameters
{
    /**
     * @var ArrayFinder the current configuration
     */
    private $configuration;

    /**
     * @var string the PHP filename
     */
    private $filename;

    public function __construct($filename)
    {
        if (!is_readable($filename)) {
            throw new InvalidArgumentException("File $filename is not readable for configuration");
        }

        $this->filename = $filename;
        $phpArray = require $this->filename;
        $this->configuration = new ArrayFinder($phpArray);
    }

    /**
     * @return array return the complete configuration
     */
    public function getConfiguration()
    {
        return $this->configuration->get();
    }

    /**
     * Insert a value into configuration at the specified path.
     *
     * @param string $propertyPath
     * @param mixed $value
     */
    public function setProperty($propertyPath, $value)
    {
        $this->configuration->set($propertyPath, $value);
    }

    /**
     * Persist the modifications done on the original configuration file.
     *
     * @return bool
     */
    public function saveConfiguration()
    {
        try {
            $filesystem = new Filesystem();
            $filesystem->dumpFile($this->filename, '<?php return ' . var_export($this->configuration->get(), true) . ';' . "\n");

            if (function_exists('opcache_invalidate')) {
                @opcache_invalidate($this->filename);
            }
        } catch (IOException $e) {
            return false;
        }

        return true;
    }
}
