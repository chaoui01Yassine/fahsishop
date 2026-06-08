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

use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductType;
use PrestaShop\PrestaShop\Core\Form\FormChoiceAttributeProviderInterface;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductTypeType extends ChoiceType
{
    /**
     * @var FormChoiceProviderInterface|FormChoiceAttributeProviderInterface
     */
    private $formChoiceProvider;

    /**
     * @param FormChoiceProviderInterface|FormChoiceAttributeProviderInterface $formChoiceProvider
     */
    public function __construct(
        $formChoiceProvider
    ) {
        parent::__construct();
        $this->formChoiceProvider = $formChoiceProvider;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'choices' => $this->formChoiceProvider->getChoices(),
            'choice_attr' => $this->formChoiceProvider->getChoicesAttributes(),
            'required' => true,
            'label' => false,
            'empty_data' => ProductType::TYPE_STANDARD,
            'block_prefix' => 'product_type',
        ]);
    }
}
