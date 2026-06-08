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

namespace PrestaShop\PrestaShop\Adapter\Attachment\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Attachment\AbstractAttachmentHandler;
use PrestaShop\PrestaShop\Core\Domain\Attachment\Exception\AttachmentNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\Attachment\Query\GetAttachment;
use PrestaShop\PrestaShop\Core\Domain\Attachment\QueryHandler\GetAttachmentHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Attachment\QueryResult\Attachment;

/**
 * Provides path and original file name of attachment
 */
final class GetAttachmentHandler extends AbstractAttachmentHandler implements GetAttachmentHandlerInterface
{
    /**
     * @var string
     */
    private $downloadDirectory;

    /**
     * @param string $downloadDirectory
     */
    public function __construct(string $downloadDirectory)
    {
        $this->downloadDirectory = $downloadDirectory;
    }

    /**
     * {@inheritdoc}
     *
     * @throws AttachmentNotFoundException
     */
    public function handle(GetAttachment $query): Attachment
    {
        $attachment = $this->getAttachment($query->getAttachmentId());
        $path = $this->downloadDirectory . $attachment->file;

        if (!file_exists($path)) {
            throw new AttachmentNotFoundException(sprintf('Attachment file was not found at %s', $path));
        }

        return new Attachment(
            $path,
            $attachment->file_name
        );
    }
}
