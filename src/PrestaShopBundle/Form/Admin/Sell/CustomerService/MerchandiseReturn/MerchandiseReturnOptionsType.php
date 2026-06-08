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

namespace PrestaShopBundle\Form\Admin\Sell\CustomerService\MerchandiseReturn;

use PrestaShopBundle\Form\Admin\Type\MultistoreConfigurationType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

/**
 * Form type for merchandise returns options
 */
class MerchandiseReturnOptionsType extends TranslatorAwareType
{
    public const FIELD_ENABLE_ORDER_RETURN = 'enable_order_return';
    public const FIELD_ORDER_RETURN_PERIOD_IN_DAYS = 'order_return_period_in_days';
    public const FIELD_ORDER_RETURN_PREFIX = 'order_return_prefix';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(static::FIELD_ENABLE_ORDER_RETURN, SwitchType::class, [
                'label' => $this->trans(
                    'Enable returns',
                    'Admin.Orderscustomers.Feature'
                ),
                'required' => false,
                'multistore_configuration_key' => 'PS_ORDER_RETURN',
            ])
            ->add(static::FIELD_ORDER_RETURN_PERIOD_IN_DAYS, IntegerType::class, [
                'label' => $this->trans(
                    'Return window',
                    'Admin.Orderscustomers.Feature'
                ),
                'help' => $this->trans(
                    'Maximum number of days to return a product after the delivery date.',
                    'Admin.Orderscustomers.Help'
                ),
                'required' => false,
                'constraints' => new GreaterThanOrEqual([
                    'value' => 0,
                ]),
                'multistore_configuration_key' => 'PS_ORDER_RETURN_NB_DAYS',
            ])
            ->add(static::FIELD_ORDER_RETURN_PREFIX, TranslatableType::class, [
                'label' => $this->trans(
                    'Return prefix',
                    'Admin.Orderscustomers.Feature'
                ),
                'help' => $this->trans(
                    'Prefix used for merchandise returns (e.g. RE00001).',
                    'Admin.Orderscustomers.Help'
                ),
                'required' => false,
                'multistore_configuration_key' => 'PS_RETURN_PREFIX',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @see MultistoreConfigurationTypeExtension
     */
    public function getParent(): string
    {
        return MultistoreConfigurationType::class;
    }
}
