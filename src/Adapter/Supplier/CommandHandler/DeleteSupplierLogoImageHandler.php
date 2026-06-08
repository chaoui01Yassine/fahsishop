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

namespace PrestaShop\PrestaShop\Adapter\Supplier\CommandHandler;

use ImageType;
use PrestaShop\PrestaShop\Core\Domain\Supplier\Command\DeleteSupplierLogoImageCommand;
use PrestaShop\PrestaShop\Core\Domain\Supplier\CommandHandler\DeleteSupplierLogoImageHandlerInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Handles command which deletes supplier cover image using legacy object model
 */
class DeleteSupplierLogoImageHandler implements DeleteSupplierLogoImageHandlerInterface
{
    /**
     * @var string
     */
    protected $imageDir;

    /**
     * @var string
     */
    protected $tmpImageDir;

    public function __construct(string $imageDir, string $tmpImageDir)
    {
        $this->imageDir = $imageDir;
        $this->tmpImageDir = $tmpImageDir;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(DeleteSupplierLogoImageCommand $command): void
    {
        $fs = new Filesystem();

        $imageTypes = ImageType::getImagesTypes('suppliers');

        foreach ($imageTypes as $imageType) {
            $path = sprintf(
                '%s%s-%s.jpg',
                $this->imageDir,
                $command->getSupplierId()->getValue(),
                stripslashes($imageType['name'])
            );
            if ($fs->exists($path)) {
                $fs->remove($path);
            }
        }

        $imagePath = sprintf(
            '%s%s.jpg',
            $this->imageDir,
            $command->getSupplierId()->getValue()
        );
        if ($fs->exists($imagePath)) {
            $fs->remove($imagePath);
        }

        // Delete tmp image
        $imgTmpPath = sprintf(
            '%ssupplier_%s.jpg',
            $this->tmpImageDir,
            $command->getSupplierId()->getValue()
        );
        if ($fs->exists($imgTmpPath)) {
            $fs->remove($imgTmpPath);
        }

        // Delete tmp image mini
        $imgMiniTmpPath = sprintf(
            '%ssupplier_mini_%s.jpg',
            $this->tmpImageDir,
            $command->getSupplierId()->getValue()
        );
        if ($fs->exists($imgMiniTmpPath)) {
            $fs->remove($imgMiniTmpPath);
        }
    }
}
