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

namespace PrestaShopBundle\Form\Admin\Improve\International\Translations;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AddUpdateLanguageType is responsible for building add / update language form
 * in 'Improve > International > Translations' page.
 */
class AddUpdateLanguageType extends TranslatorAwareType
{
    /**
     * @var array
     */
    private $nonInstalledLocalizationChoices;

    /**
     * @param TranslatorInterface $translator
     * @param array $locales
     * @param array $nonInstalledLocalizationChoices
     */
    public function __construct(
        TranslatorInterface $translator,
        array $locales,
        array $nonInstalledLocalizationChoices
    ) {
        parent::__construct($translator, $locales);
        $this->nonInstalledLocalizationChoices = $nonInstalledLocalizationChoices;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iso_localization_pack', ChoiceType::class, [
            'label' => $this->trans('Please select the language you want to add or update', 'Admin.International.Feature'),
            'attr' => [
                'data-minimumResultsForSearch' => '7',
                'data-toggle' => 'select2',
            ],
            'choices' => [
                $this->trans('Update a language', 'Admin.International.Feature') => $this->getLocaleChoices(),
                $this->trans('Add a language', 'Admin.International.Feature') => $this->nonInstalledLocalizationChoices,
            ],
            'choice_translation_domain' => false,
        ]);
    }
}
