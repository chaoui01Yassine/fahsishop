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

namespace PrestaShopBundle\Form\Admin\Configure\AdvancedParameters\Email;

use PrestaShopBundle\Form\Admin\Type\EmailType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestEmailSendingType is responsible for building form type used to send testing emails.
 */
class TestEmailSendingType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('send_email_to', EmailType::class, [
                'label' => $this->trans('Send a test email to', 'Admin.Advparameters.Feature'),
            ])
            ->add('mail_method', HiddenType::class)
            ->add('smtp_server', HiddenType::class)
            ->add('smtp_username', HiddenType::class)
            ->add('smtp_password', HiddenType::class)
            ->add('smtp_port', HiddenType::class)
            ->add('smtp_encryption', HiddenType::class)
            ->add('dkim_enable', HiddenType::class)
            ->add('dkim_key', HiddenType::class)
            ->add('dkim_domain', HiddenType::class)
            ->add('dkim_selector', HiddenType::class);
    }
}
