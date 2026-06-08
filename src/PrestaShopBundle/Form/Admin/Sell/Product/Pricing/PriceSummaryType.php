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

namespace PrestaShopBundle\Form\Admin\Sell\Product\Pricing;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceSummaryType extends TranslatorAwareType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => $this->trans('Summary', 'Admin.Global'),
            'label_tag_name' => 'h3',
            'attr' => [
                'class' => 'price-summary-widget form-group',
                'data-price-tax-excluded' => $this->trans('%price% tax excl.', 'Admin.Catalog.Feature'),
                'data-price-tax-included' => $this->trans('%price% tax incl.', 'Admin.Catalog.Feature'),
                'data-unit-price' => $this->trans('%price% %unity%', 'Admin.Catalog.Feature'),
                'data-margin' => $this->trans('%price% margin', 'Admin.Catalog.Feature'),
                'data-margin-rate' => $this->trans('%margin_rate%% margin rate', 'Admin.Catalog.Feature'),
                'data-wholesale-price' => $this->trans('%price% cost price', 'Admin.Catalog.Feature'),
            ],
        ]);
    }
}
