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

namespace PrestaShopBundle\Form\Admin\Sell\Product;

use PrestaShopBundle\Form\Admin\Type\ShopSelectorType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductFormType extends TranslatorAwareType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ProductTypeType::class)
            ->add('shop_id', HiddenType::class)
            ->add('create', SubmitType::class, [
                'label' => $this->trans('Add new product', 'Admin.Catalog.Feature'),
                'row_attr' => [
                    'class' => 'text-right',
                ],
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            if (!empty($data['shop_id'])) {
                return;
            }

            // If no shop as pre-selected we use the shop selector input instead of a hidden one
            $form = $event->getForm();
            $form->add('shop_id', ShopSelectorType::class);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'label' => false,
            'attr' => [
                'data-modal-title' => $this->trans('Add new product', 'Admin.Catalog.Feature'),
            ],
            'form_theme' => '@PrestaShop/Admin/Sell/Catalog/Product/FormTheme/product.html.twig',
            'use_default_themes' => false,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getBlockPrefix()
    {
        return 'create_product';
    }
}
