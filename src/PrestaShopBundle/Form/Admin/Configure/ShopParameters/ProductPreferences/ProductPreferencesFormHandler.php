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

namespace PrestaShopBundle\Form\Admin\Configure\ShopParameters\ProductPreferences;

use PrestaShop\PrestaShop\Core\Cache\Clearer\CacheClearerInterface;
use PrestaShop\PrestaShop\Core\Form\Handler;

/**
 * Class manages the data manipulated using forms
 * in "Configure > Shop Parameters > Product Settings" page.
 */
class ProductPreferencesFormHandler extends Handler
{
    /**
     * @var CacheClearerInterface
     */
    private $cacheClearer;

    /**
     * {@inheritdoc}
     */
    public function save(array $data)
    {
        $errors = $this->formDataProvider->setData($data);

        if (empty($errors)) {
            $this->cacheClearer->clear();

            if (isset($data['stock_management']) && !$data['stock_management']) {
                $data['allow_ordering_oos'] = 1;
            }
        }

        return parent::save($data);
    }

    /**
     * Inject the cache clearer if needed.
     *
     * @param CacheClearerInterface $cacheClearer the Cache clearer
     */
    public function setCacheClearer(CacheClearerInterface $cacheClearer)
    {
        $this->cacheClearer = $cacheClearer;
    }
}
