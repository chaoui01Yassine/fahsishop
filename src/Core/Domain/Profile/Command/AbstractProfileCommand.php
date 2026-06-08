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

namespace PrestaShop\PrestaShop\Core\Domain\Profile\Command;

use PrestaShop\PrestaShop\Core\Domain\Profile\Exception\ProfileConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Profile\Exception\ProfileException;
use PrestaShop\PrestaShop\Core\Domain\Profile\ProfileSettings;

abstract class AbstractProfileCommand
{
    /**
     * @var string[]
     */
    protected $localizedNames;

    /**
     * @param string[] $localizedNames
     *
     * @throws ProfileConstraintException
     */
    public function __construct(array $localizedNames)
    {
        if (empty($localizedNames)) {
            throw new ProfileException('Profile name cannot be empty');
        }

        foreach ($localizedNames as $localizedName) {
            $this->assertNameIsStringAndRequiredLength($localizedName);
        }
        $this->localizedNames = $localizedNames;
    }

    /**
     * @return string[]
     */
    public function getLocalizedNames()
    {
        return $this->localizedNames;
    }

    /**
     * @param mixed $name
     */
    protected function assertNameIsStringAndRequiredLength($name)
    {
        if (null !== $name && !is_string($name) || strlen($name) > ProfileSettings::NAME_MAX_LENGTH) {
            throw new ProfileConstraintException(
                sprintf(
                    'Profile name should not exceed %d characters length but %s given',
                    ProfileSettings::NAME_MAX_LENGTH,
                    var_export($name, true)
                ),
                ProfileConstraintException::INVALID_NAME
            );
        }
    }
}
