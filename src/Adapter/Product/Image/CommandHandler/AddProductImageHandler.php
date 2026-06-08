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

namespace PrestaShop\PrestaShop\Adapter\Product\Image\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Image\ProductImageFileValidator;
use PrestaShop\PrestaShop\Adapter\Product\Image\Repository\ProductImageRepository;
use PrestaShop\PrestaShop\Adapter\Product\Image\Uploader\ProductImageUploader;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\Command\AddProductImageCommand;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\CommandHandler\AddProductImageHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\ValueObject\ImageId;

/**
 * Handles @see AddProductImageCommand
 */
final class AddProductImageHandler implements AddProductImageHandlerInterface
{
    /**
     * @var ProductImageUploader
     */
    private $productImageUploader;

    /**
     * @var ProductImageFileValidator
     */
    private $imageValidator;

    /**
     * @var ProductImageRepository
     */
    private $productImageRepository;

    public function __construct(
        ProductImageUploader $productImageUploader,
        ProductImageRepository $productImageRepository,
        ProductImageFileValidator $imageValidator
    ) {
        $this->productImageUploader = $productImageUploader;
        $this->imageValidator = $imageValidator;
        $this->productImageRepository = $productImageRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(AddProductImageCommand $command): ImageId
    {
        $filePath = $command->getFilePath();
        $this->imageValidator->assertFileUploadLimits($filePath);
        $this->imageValidator->assertIsValidImageType($filePath);

        $image = $this->productImageRepository->create($command->getProductId(), $command->getShopConstraint());
        $this->productImageUploader->upload($image, $filePath);

        return new ImageId((int) $image->id);
    }
}
