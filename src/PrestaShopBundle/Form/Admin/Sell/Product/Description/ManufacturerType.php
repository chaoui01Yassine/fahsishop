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

namespace PrestaShopBundle\Form\Admin\Sell\Product\Description;

use PrestaShop\PrestaShop\Core\Domain\Manufacturer\ValueObject\NoManufacturerId;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ManufacturerType extends ChoiceType
{
    private const MANUFACTURER_MIN_RESULTS_FOR_SEARCH = 7;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var FormChoiceProviderInterface
     */
    private $manufacturerChoiceProvider;

    /**
     * @param TranslatorInterface $translator
     * @param FormChoiceProviderInterface $manufacturerChoiceProvider
     */
    public function __construct(
        TranslatorInterface $translator,
        FormChoiceProviderInterface $manufacturerChoiceProvider
    ) {
        parent::__construct();
        $this->translator = $translator;
        $this->manufacturerChoiceProvider = $manufacturerChoiceProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $manufacturers = $this->manufacturerChoiceProvider->getChoices();
        $choices = array_merge([
            $this->trans('No brand', 'Admin.Catalog.Feature') => NoManufacturerId::NO_MANUFACTURER_ID,
        ], $manufacturers);

        $resolver->setDefaults([
            'label' => $this->trans('Brand', 'Admin.Catalog.Feature'),
            'label_tag_name' => 'h3',
            'required' => false,
            // placeholder false is important to avoid empty option in select input despite required being false
            'placeholder' => false,
            'choices' => $choices,
            'attr' => [
                'data-toggle' => 'select2',
                'data-minimumResultsForSearch' => self::MANUFACTURER_MIN_RESULTS_FOR_SEARCH,
            ],
        ]);
    }

    /**
     * @param string $key
     * @param string $domain
     * @param array $parameters
     *
     * @return string
     */
    protected function trans(string $key, string $domain, array $parameters = []): string
    {
        return $this->translator->trans($key, $parameters, $domain);
    }
}
