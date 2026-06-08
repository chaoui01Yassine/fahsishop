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

namespace PrestaShop\PrestaShop\Core\ConstraintValidator;

use PrestaShop\Decimal\DecimalNumber;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validates @see PositiveOrZero constraint
 */
class PositiveOrZeroValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PositiveOrZero) {
            throw new UnexpectedTypeException($constraint, PositiveOrZero::class);
        }

        if (!is_numeric($value) || !(new DecimalNumber((string) $value))->isGreaterOrEqualThanZero()) {
            $this->context->buildViolation($constraint->message)
                ->setTranslationDomain('Admin.Notifications.Error')
                ->addViolation()
            ;
        }
    }
}
