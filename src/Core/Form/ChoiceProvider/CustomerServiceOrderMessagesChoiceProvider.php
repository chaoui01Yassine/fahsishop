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

use PrestaShop\PrestaShop\Adapter\OrderMessage\OrderMessageProvider;
use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;

/**
 * Selects order messages itself.
 */
final class CustomerServiceOrderMessagesChoiceProvider implements ConfigurableFormChoiceProviderInterface
{
    /**
     * @var OrderMessageProvider
     */
    private $orderMessageProvider;

    public function __construct(OrderMessageProvider $orderMessageProvider)
    {
        $this->orderMessageProvider = $orderMessageProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices(array $options): array
    {
        $result = [];

        foreach ($this->orderMessageProvider->getMessages($options['lang_id']) as $orderMessage) {
            $result[$orderMessage['id_order_message']] = $orderMessage['message'];
        }

        return $result;
    }
}
