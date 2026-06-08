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

namespace PrestaShopBundle\Form\Admin\Product;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @deprecated since 8.1 and will be removed in next major.
 *
 * This form class is responsible to generate the basic product Warehouse combinations form.
 */
class ProductWarehouseCombination extends CommonAbstractType
{
    private $translator;

    /**
     * Constructor.
     *
     * @param object $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     *
     * Builds form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activated', CheckboxType::class, [
            'required' => false,
            'label' => $this->translator->trans('Stored', [], 'Admin.Catalog.Feature'),
        ])
            ->add('id_product_attribute', HiddenType::class)
            ->add('product_id', HiddenType::class)
            ->add('warehouse_id', HiddenType::class)
            ->add('location', TextType::class, [
                'required' => false,
                'label' => $this->translator->trans('Location (optional)', [], 'Admin.Catalog.Feature'),
                'empty_data' => '',
            ]);

        //set default minimal values for collection prototype
        $builder->setData([
            'warehouse_id' => $options['id_warehouse'],
            'warehouse_activated' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'id_warehouse' => null,
        ]);
    }

    /**
     * Returns the block prefix of this type.
     *
     * @return string The prefix name
     */
    public function getBlockPrefix()
    {
        return 'product_warehouse_combination';
    }
}
