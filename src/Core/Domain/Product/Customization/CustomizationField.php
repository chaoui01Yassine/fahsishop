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

namespace PrestaShop\PrestaShop\Core\Domain\Product\Customization;

/**
 * Transfers customization field data
 */
class CustomizationField
{
    /**
     * @var int
     */
    private $type;

    /**
     * @var string[]
     */
    private $localizedNames;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var bool
     */
    private $addedByModule;

    /**
     * @var int|null
     */
    private $customizationFieldId;

    /**
     * @param int $type
     * @param string[] $localizedNames
     * @param bool $required
     * @param bool $addedByModule
     * @param int|null $customizationFieldId If provided, means that its existing CustomizationField and should be updated
     */
    public function __construct(
        int $type,
        array $localizedNames,
        bool $required,
        bool $addedByModule = false,
        ?int $customizationFieldId = null
    ) {
        $this->type = $type;
        $this->localizedNames = $localizedNames;
        $this->required = $required;
        $this->addedByModule = $addedByModule;
        $this->customizationFieldId = $customizationFieldId ?? null;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string[]
     */
    public function getLocalizedNames(): array
    {
        return $this->localizedNames;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return bool
     */
    public function isAddedByModule(): bool
    {
        return $this->addedByModule;
    }

    /**
     * @return int|null
     */
    public function getCustomizationFieldId(): ?int
    {
        return $this->customizationFieldId;
    }
}
