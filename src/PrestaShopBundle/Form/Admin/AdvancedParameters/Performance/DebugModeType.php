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

namespace PrestaShopBundle\Form\Admin\AdvancedParameters\Performance;

use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * This form class generates the "Debug mode" form in Performance page.
 */
class DebugModeType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('disable_overrides', SwitchType::class, [
                'required' => false,
                'label' => $this->trans('Disable all overrides', 'Admin.Advparameters.Feature'),
                'help' => $this->trans('Enable or disable all classes and controllers overrides.', 'Admin.Advparameters.Feature'),
            ])
            ->add('debug_mode', SwitchType::class, [
                'required' => false,
                'label' => $this->trans('Debug mode', 'Admin.Advparameters.Feature'),
                'help' => $this->trans('Enable or disable debug mode. Debug mode will enable extended error reporting, display the Symfony debug bar, and other features.', 'Admin.Advparameters.Help'),
            ])
            ->add('debug_profiling', SwitchType::class, [
                'required' => false,
                'label' => $this->trans('Debug profiler', 'Admin.Advparameters.Feature'),
                'help' => $this->trans('Enable or disable debug profiling. Debug profiling will display performance-related information under each page and help find performance bottlenecks in your store.', 'Admin.Advparameters.Help'),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'performance_debug_mode_block';
    }
}
