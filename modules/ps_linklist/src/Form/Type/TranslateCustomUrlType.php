<?php
/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\LinkList\Form\Type;

use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TranslatableUrlType.
 */
class TranslateCustomUrlType extends TranslatableType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['locales'] as $locale) {
            $localeOptions = $options['options'];
            $localeOptions['label'] = $locale['iso_code'];

            if (!isset($localeOptions['required'])) {
                $localeOptions['required'] = false;
            }

            $builder->add($locale['id_lang'], CustomUrlType::class, $localeOptions);
        }
    }
}
