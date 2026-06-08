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

namespace PrestaShopBundle\Form\Admin\Improve\International\Localization;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AdvancedConfigurationType is responsible for building 'Improve > International > Localization' page
 * 'Advanced' form.
 */
class AdvancedConfigurationType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('language_identifier', TextType::class, [
                'label' => $this->trans(
                    'Language identifier',
                    'Admin.International.Feature'
                ),
                'help' => $this->trans(
                    'The ISO 639-1 identifier for the language of the country where your web server is located (en, fr, sp, ru, pl, nl, etc.).',
                    'Admin.International.Help'
                ),
            ])
            ->add('country_identifier', TextType::class, [
                'label' => $this->trans(
                    'Country identifier',
                    'Admin.International.Feature'
                ),
                'help' => $this->trans(
                    'The ISO 3166-1 alpha-2 identifier for the country/region where your web server is located, in lowercase (us, gb, fr, sp, ru, pl, nl, etc.).',
                    'Admin.International.Help'
                ),
            ]);
    }
}
