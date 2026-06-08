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

namespace PrestaShopBundle\Form\Admin\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines reusable text input with max length counter
 */
class TextWithLengthCounterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['max_length'] = $options['max_length'];
        $view->vars['position'] = $options['position'];
        $view->vars['input'] = $options['input'];
        $view->vars['input_attr'] = $options['input_attr'];
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'max_length',
            ])
            ->setDefaults([
                'position' => 'before',
                'input' => 'text',
                'input_attr' => [],
                'compound' => false,
            ])
            ->setAllowedTypes('max_length', 'int')
            ->setAllowedTypes('input_attr', ['array'])
            ->setAllowedValues('position', ['before', 'after'])
            ->setAllowedValues('input', ['text', 'textarea'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'text_with_length_counter';
    }
}
