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

namespace PrestaShopBundle\Form\Admin\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RadioWithChoiceChildrenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add($options['radio_name'], RadioType::class, [
            'required' => false,
            'label' => $options['radio_label'],
        ]);

        if (isset($options['child_choice'])) {
            $childChoice = $options['child_choice'];
            $childChoiceAttr = [];
            if (isset($childChoice['empty'])) {
                $childChoice['choices'] = array_merge([$childChoice['empty'] => ''], $childChoice['choices']);
                $childChoiceAttr[$childChoice['empty']] = ['disabled' => true];
            }
            $builder->add($childChoice['name'], ChoiceType::class, [
                'label' => false,
                'row_attr' => [
                    'class' => 'export-translations-child',
                ],
                'choices' => $childChoice['choices'],
                'choice_attr' => $childChoiceAttr,
                'expanded' => $childChoice['multiple'], //same value as multiple. We can only have Select or Checkboxes
                'multiple' => $childChoice['multiple'],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired([
                'radio_name',
                'radio_label',
                'child_choice',
            ])
        ;

        $resolver->setAllowedTypes('child_choice', 'array');
        $resolver->setAllowedTypes('radio_name', 'string');
        $resolver->setAllowedTypes('radio_label', 'string');
    }
}
