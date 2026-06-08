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

namespace PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Attribute\QueryResult;

class Attribute
{
    /**
     * @var int
     */
    private $attributeId;

    /**
     * @var int
     */
    private $position;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string[] key => value pairs where each key represents language id
     */
    private $localizedNames;

    /**
     * @var string|null
     */
    private $textureFilePath;

    /**
     * @param int $attributeId
     * @param int $position
     * @param string $color
     * @param string[] $localizedNames key => value pairs where each key represents language id
     */
    public function __construct(
        int $attributeId,
        int $position,
        string $color,
        array $localizedNames,
        string $textureFilePath = null
    ) {
        $this->attributeId = $attributeId;
        $this->position = $position;
        $this->color = $color;
        $this->localizedNames = $localizedNames;
        $this->textureFilePath = $textureFilePath;
    }

    /**
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->attributeId;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string[]
     */
    public function getLocalizedNames(): array
    {
        return $this->localizedNames;
    }

    public function getTextureFilePath(): ?string
    {
        return $this->textureFilePath;
    }
}
