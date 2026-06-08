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

namespace PrestaShop\PrestaShop\Adapter\Profile\CommandHandler;

use PrestaShop\PrestaShop\Core\Domain\Profile\Command\EditProfileCommand;
use PrestaShop\PrestaShop\Core\Domain\Profile\CommandHandler\EditProfileHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Profile\Exception\ProfileException;
use PrestaShop\PrestaShop\Core\Domain\Profile\Exception\ProfileNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\Profile\ValueObject\ProfileId;
use Profile;

/**
 * Edits Profile using legacy object model
 */
final class EditProfileHandler implements EditProfileHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(EditProfileCommand $command)
    {
        $profile = $this->getProfile($command->getProfileId());
        $profile->name = $command->getLocalizedNames();

        if (false === $profile->validateFieldsLang(false)) {
            throw new ProfileException('Cannot edit Profile because it contains invalid data');
        }

        if (false === $profile->update()) {
            throw new ProfileException('Failed to edit Profile');
        }
    }

    /**
     * @param ProfileId $profileId
     *
     * @return Profile
     *
     * @throws ProfileNotFoundException
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    private function getProfile(ProfileId $profileId)
    {
        $profile = new Profile($profileId->getValue());

        if ($profile->id !== $profileId->getValue()) {
            throw new ProfileNotFoundException(sprintf('Profile with id "%s" was not found', $profileId->getValue()));
        }

        return $profile;
    }
}
