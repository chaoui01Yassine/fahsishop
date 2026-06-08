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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\Domain\Customer\ValueObject\CustomerDeleteMethod;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Provides choices in which customer can be deleted.
 */
final class CustomerDeleteMethodChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $allowRegistrationLabel = $this->translator->trans(
            'I want my customers to be able to register again with the same email address. All data will be removed from the database.',
            [],
            'Admin.Orderscustomers.Notification'
        );

        $denyRegistraionLabel = $this->translator->trans(
            'I do not want my customer(s) to register again with the same email address. All selected customer(s) will be removed from this list but their corresponding data will be kept in the database.',
            [],
            'Admin.Orderscustomers.Notification'
        );

        return [
            $allowRegistrationLabel => CustomerDeleteMethod::ALLOW_CUSTOMER_REGISTRATION,
            $denyRegistraionLabel => CustomerDeleteMethod::DENY_CUSTOMER_REGISTRATION,
        ];
    }
}
