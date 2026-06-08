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

namespace PrestaShopBundle\Form\Admin\Sell\Product\Shipping;

use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryTimeNotesType extends TranslatorAwareType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('in_stock', TranslatableType::class, [
                'label' => $this->trans('Delivery time of in-stock products:', 'Admin.Catalog.Feature'),
                'type' => TextType::class,
                'required' => false,
                'options' => [
                    'attr' => [
                        'placeholder' => $this->trans('Delivered within 3-4 days', 'Admin.Catalog.Feature'),
                    ],
                ],
                'modify_all_shops' => true,
            ])
            ->add('out_of_stock', TranslatableType::class, [
                'locales' => $this->locales,
                'required' => false,
                'label' => $this->trans(
                    'Delivery time of out-of-stock products with allowed orders:',
                    'Admin.Catalog.Feature'
                ),
                'options' => [
                    'attr' => [
                        'placeholder' => $this->trans('Delivered within 5-7 days', 'Admin.Catalog.Feature'),
                    ],
                ],
                'modify_all_shops' => true,
            ])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'label' => false,
            'columns_number' => 2,
        ]);
    }
}
