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

namespace PrestaShop\PrestaShop\Adapter\Form\ChoiceProvider;

use Context;
use Country;
use Db;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Shop;

/**
 * Choices for countries in which at least one order has been placed
 */
final class OrderCountriesChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        if (!Country::isCurrentlyUsed('country', true)) {
            return [];
        }

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT DISTINCT c.id_country, cl.`name`
			FROM `' . _DB_PREFIX_ . 'orders` o
			' . Shop::addSqlAssociation('orders', 'o') . '
			INNER JOIN `' . _DB_PREFIX_ . 'address` a
			    ON a.id_address = o.id_address_delivery
			INNER JOIN `' . _DB_PREFIX_ . 'country` c
			    ON a.id_country = c.id_country
			INNER JOIN `' . _DB_PREFIX_ . 'country_lang` cl
			    ON (c.`id_country` = cl.`id_country`
			        AND cl.`id_lang` = ' . (int) Context::getContext()->language->id . ')
			ORDER BY cl.name ASC'
        );

        $choices = [];

        foreach ($result as $row) {
            $choices[$row['name']] = $row['id_country'];
        }

        return $choices;
    }
}
