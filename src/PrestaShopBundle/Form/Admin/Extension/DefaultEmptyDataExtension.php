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

namespace PrestaShopBundle\Form\Admin\Extension;

use PrestaShopBundle\Form\DataTransformer\DefaultEmptyDataTransformer;
use stdClass;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DefaultEmptyDataExtension extends every form type with additional default_empty_data option.
 */
class DefaultEmptyDataExtension extends AbstractTypeExtension
{
    /**
     * @var stdClass
     */
    private $privateEmptyValue;

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        // We cannot use null as empty value so we create a private object that will allow us to detect that the
        // empty_view_data option has been explicitly set EVEN if it is null
        $this->privateEmptyValue = new stdClass();

        $resolver
            ->setDefaults([
                'default_empty_data' => null,
                'empty_view_data' => $this->privateEmptyValue,
            ])
            ->setAllowedTypes('default_empty_data', ['null', 'string', 'int', 'array', 'object', 'bool', 'float'])
            ->setAllowedTypes('empty_view_data', ['null', 'string', 'int', 'array', 'object', 'bool', 'float'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        if (!isset($options['default_empty_data'])) {
            return;
        }

        if ($options['empty_view_data'] !== $this->privateEmptyValue) {
            // This different use case is important because DefaultEmptyDataTransformer has a different behaviour when
            // the second parameter is provided, especially when you need to force null as the view data
            $transformer = new DefaultEmptyDataTransformer($options['default_empty_data'], $options['empty_view_data']);
        } else {
            $transformer = new DefaultEmptyDataTransformer($options['default_empty_data']);
        }

        $builder->addModelTransformer($transformer);
        $builder->addViewTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes(): iterable
    {
        return [FormType::class];
    }
}
