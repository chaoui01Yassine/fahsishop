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

namespace PrestaShop\PrestaShop\Adapter\SqlManager\CommandHandler;

use PrestaShop\PrestaShop\Adapter\SqlManager\SqlQueryValidator;
use PrestaShop\PrestaShop\Core\Domain\SqlManagement\Exception\SqlRequestConstraintException;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @internal
 */
abstract class AbstractSqlRequestHandler
{
    /**
     * @var SqlQueryValidator
     */
    private $sqlQueryValidator;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        SqlQueryValidator $sqlQueryValidator,
        TranslatorInterface $translator
    ) {
        $this->sqlQueryValidator = $sqlQueryValidator;
        $this->translator = $translator;
    }

    protected function assertSqlQueryIsValid(string $sql): void
    {
        $errors = $this->sqlQueryValidator->validate($sql);
        if (0 !== count($errors)) {
            $message = $this->translator->trans(
                $errors[0]['key'],
                $errors[0]['parameters'],
                $errors[0]['domain']
            );

            throw new SqlRequestConstraintException(
                $message,
                SqlRequestConstraintException::INVALID_SQL_QUERY
            );
        }
    }
}
