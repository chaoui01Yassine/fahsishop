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

namespace PrestaShop\PrestaShop\Core\Domain\Profile\Permission\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Profile\Permission\Exception\InvalidPermissionValueException;

class ModulePermission implements PermissionInterface
{
    public const VIEW = 'view';
    public const CONFIGURE = 'configure';
    public const UNINSTALL = 'uninstall';

    public const SUPPORTED_PERMISSIONS = [
        self::VIEW,
        self::CONFIGURE,
        self::UNINSTALL,
    ];

    /**
     * @var string
     */
    private $permission;

    /**
     * @param string $permission
     */
    public function __construct(string $permission)
    {
        $this->assertPermissionIsSupported($permission);

        $this->permission = $permission;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->permission;
    }

    protected function assertPermissionIsSupported(string $permission): void
    {
        if (!in_array($permission, static::SUPPORTED_PERMISSIONS)) {
            throw new InvalidPermissionValueException(
                sprintf('Invalid permission "%s" provided', $permission)
            );
        }
    }
}
