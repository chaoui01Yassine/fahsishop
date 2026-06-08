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

namespace PrestaShop\PrestaShop\Adapter\Product;

use Db;

/**
 * @deprecated since 8.1 and will be removed in next major.
 *
 * This class will provide data from DB / ORM about attachment.
 */
class AttachmentDataProvider
{
    /**
     * Get all attachments.
     *
     * @param int $id_lang
     *
     * @return array Attachment
     */
    public function getAllAttachments($id_lang)
    {
        return Db::getInstance()->executeS('
			SELECT *
			FROM ' . _DB_PREFIX_ . 'attachment a
			LEFT JOIN ' . _DB_PREFIX_ . 'attachment_lang al
				ON (a.id_attachment = al.id_attachment AND al.id_lang = ' . (int) $id_lang . ')
        ');
    }
}
