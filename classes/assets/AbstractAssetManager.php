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
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

abstract class AbstractAssetManagerCore
{
    use PrestaShop\PrestaShop\Adapter\Assets\AssetUrlGeneratorTrait;
    protected $directories;
    protected $configuration;
    protected $list = [];

    public const DEFAULT_MEDIA = 'all';
    public const DEFAULT_PRIORITY = 50;
    public const DEFAULT_JS_POSITION = 'bottom';

    public function __construct(array $directories, ConfigurationInterface $configuration)
    {
        $this->directories = $directories;
        $this->configuration = $configuration;

        $this->list = $this->getDefaultList();
    }

    abstract protected function getDefaultList();

    abstract protected function getList();

    /**
     * @param string $relativePath
     *
     * @return bool|string
     */
    public function getFullPath(string $relativePath)
    {
        foreach ($this->getDirectories() as $baseDir) {
            $fullPath = $baseDir . ltrim($relativePath, '/'); // not DIRECTORY_SEPARATOR because, it's path included manually
            if (file_exists($this->getPathFromUri($fullPath))) {
                return $fullPath;
            }
        }

        return false;
    }

    private function getDirectories()
    {
        static $directories;

        if (null === $directories) {
            foreach ($this->directories as $baseDir) {
                if (!empty($baseDir)) {
                    $directories[] = $baseDir;
                }
            }
        }

        return $directories;
    }
}
