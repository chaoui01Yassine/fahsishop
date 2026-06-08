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

namespace PrestaShop\PrestaShop\Core\Domain\Feature\Command;

use PrestaShop\PrestaShop\Core\Domain\Feature\Exception\FeatureConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Feature\ValueObject\FeatureId;

/**
 * Edit feature with given data.
 */
class EditFeatureCommand
{
    /**
     * @var FeatureId
     */
    private $featureId;

    /**
     * @var string[]
     */
    private $localizedNames;

    /**
     * @var int[]
     */
    private $associatedShopIds;

    /**
     * @param int $featureId
     */
    public function __construct($featureId)
    {
        $this->featureId = new FeatureId($featureId);
    }

    /**
     * @return FeatureId
     */
    public function getFeatureId()
    {
        return $this->featureId;
    }

    /**
     * @return string[]|null
     */
    public function getLocalizedNames()
    {
        return $this->localizedNames;
    }

    /**
     * @param string[] $localizedNames
     *
     * @return EditFeatureCommand
     */
    public function setLocalizedNames(array $localizedNames)
    {
        if (empty($localizedNames)) {
            throw new FeatureConstraintException('Feature name cannot be empty', FeatureConstraintException::EMPTY_NAME);
        }

        $this->localizedNames = $localizedNames;

        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getAssociatedShopIds()
    {
        return $this->associatedShopIds;
    }

    /**
     * @param int[] $associatedShopIds
     *
     * @return EditFeatureCommand
     */
    public function setAssociatedShopIds($associatedShopIds)
    {
        $this->associatedShopIds = $associatedShopIds;

        return $this;
    }
}
