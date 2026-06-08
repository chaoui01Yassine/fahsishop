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

namespace PrestaShop\PrestaShop\Core\Domain\Meta\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Meta\Exception\MetaException;

/**
 * Class MetaId is responsible for providing id of meta entity.
 */
class MetaId
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $metaId
     *
     * @throws MetaException
     */
    public function __construct($metaId)
    {
        $this->assertIsIntAndLargerThanZero($metaId);

        $this->id = $metaId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->id;
    }

    /**
     * @param int $metaId
     *
     * @throws MetaException
     */
    public function assertIsIntAndLargerThanZero($metaId)
    {
        if (!is_int($metaId) || $metaId <= 0) {
            throw new MetaException(sprintf('Invalid meta id: %s. It must be of type integer and above 0', var_export($metaId, true)));
        }
    }
}
