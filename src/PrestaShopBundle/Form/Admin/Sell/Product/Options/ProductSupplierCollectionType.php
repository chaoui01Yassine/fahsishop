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

namespace PrestaShopBundle\Form\Admin\Sell\Product\Options;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductSupplierCollectionType extends CollectionType
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'label' => $this->translator->trans('Supplier reference(s)', [], 'Admin.Catalog.Feature'),
            'label_tag_name' => 'h4',
            'entry_type' => ProductSupplierType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype_name' => '__PRODUCT_SUPPLIER_INDEX__',
            'attr' => [
                'class' => 'product-suppliers-collection',
            ],
            'alert_message' => $this->translator->trans(
                'You can specify product reference(s) for each associated supplier. Click "%save_label%" after changing selected suppliers to display the associated product references.',
                [
                    '%save_label%' => $this->translator->trans('Save', [], 'Admin.Actions'),
                ],
                'Admin.Catalog.Help'
            ),
            'alert_position' => 'prepend',
            'block_prefix' => 'product_supplier_collection',
            'form_theme' => '@PrestaShop/Admin/Sell/Catalog/Product/FormTheme/product_suppliers.html.twig',
        ]);
    }
}
