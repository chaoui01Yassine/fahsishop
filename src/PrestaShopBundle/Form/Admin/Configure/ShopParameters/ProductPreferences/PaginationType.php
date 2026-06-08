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

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class generates "Pagination" form
 * in "Configure > Shop Parameters > Product Settings" page.
 */
class PaginationType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('products_per_page', IntegerType::class, [
                'label' => $this->trans(
                    'Products per page',
                    'Admin.Shopparameters.Feature'
                ),
                'help' => $this->trans('Number of products displayed per page. Default is 12', 'Admin.Shopparameters.Help'),
                'required' => false,
            ])
            ->add('default_order_by', ChoiceType::class, [
                'label' => $this->trans(
                    'Default order by',
                    'Admin.Shopparameters.Feature'
                ),
                'help' => $this->trans(
                    'The order in which products are displayed in the product list.',
                    'Admin.Shopparameters.Help'
                ),
                'choices' => [
                    'Product name' => 0,
                    'Product price' => 1,
                    'Product add date' => 2,
                    'Product modified date' => 3,
                    'Position inside category' => 4,
                    'Brand' => 5,
                    'Product quantity' => 6,
                    'Product reference' => 7,
                ],
                'required' => false,
                'placeholder' => false,
            ])
            ->add('default_order_way', ChoiceType::class, [
                'label' => $this->trans(
                    'Default order method',
                    'Admin.Shopparameters.Feature'
                ),
                'choices' => [
                    'Ascending' => 0,
                    'Descending' => 1,
                ],
                'choice_translation_domain' => 'Admin.Global',
                'required' => false,
                'placeholder' => false,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'Admin.Shopparameters.Feature',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'product_preferences_pagination_block';
    }
}
