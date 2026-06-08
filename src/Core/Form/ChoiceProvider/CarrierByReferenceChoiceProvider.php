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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Adapter\Carrier\CarrierDataProvider;
use PrestaShop\PrestaShop\Adapter\Entity\Carrier;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class CarrierByReferenceChoiceProvider is responsible for providing carrier choices with value reference.
 */
final class CarrierByReferenceChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var CarrierDataProvider
     */
    private $carrierDataProvider;

    /**
     * @var int
     */
    private $langId;

    /**
     * @param CarrierDataProvider $carrierDataProvider
     * @param int $langId
     */
    public function __construct(CarrierDataProvider $carrierDataProvider, $langId)
    {
        $this->carrierDataProvider = $carrierDataProvider;
        $this->langId = $langId;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $choices = [];

        $carriers = $this->carrierDataProvider->getCarriers(
            $this->langId,
            false,
            false,
            false,
            null,
            Carrier::ALL_CARRIERS
        );

        foreach ($carriers as $carrier) {
            $choiceId = $carrier['id_carrier'] . ' - ' . $carrier['name'];
            if (!empty($carrier['delay'])) {
                $choiceId .= ' (' . $carrier['delay'] . ')';
            }

            $choices[$choiceId] = $carrier['id_reference'];
        }

        return $choices;
    }
}
