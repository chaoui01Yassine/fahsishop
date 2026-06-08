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

namespace PrestaShop\PrestaShop\Core\Image\Deleter;

/**
 * Interface ImageFileDeleterInterface describes an image file deleter.
 */
interface ImageFileDeleterInterface
{
    /**
     * Recursively deletes all images in the given path and removes empty folders.
     *
     * @param string $path images directory
     * @param bool $recursively if true deletes images from subdirectories
     * @param bool $deleteSubdirectories if true deletes the subdirectories as well
     * @param string $format image format
     *
     * @return bool
     */
    public function deleteFromPath($path, $recursively = false, $deleteSubdirectories = false, $format = 'jpg');

    /**
     * Delete all images from given path.
     *
     * @param string $path
     * @param string $format
     */
    public function deleteAllImages($path, $format = 'jpg');
}
