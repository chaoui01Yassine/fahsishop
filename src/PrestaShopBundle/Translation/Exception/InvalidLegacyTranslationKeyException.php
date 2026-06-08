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

namespace PrestaShopBundle\Translation\Exception;

/**
 * Thrown when an invalid key is found in a legacy translation file
 */
class InvalidLegacyTranslationKeyException extends \Exception
{
    /**
     * @var string The invalid key
     */
    private $key = '';

    /**
     * @param string $missingElement The missing element
     * @param string $key The offending key
     *
     * @return InvalidLegacyTranslationKeyException
     */
    public static function missingElementFromKey($missingElement, $key)
    {
        $instance = new self(
            sprintf('Invalid key in legacy translation file: "%s" (missing %s)', $key, $missingElement)
        );
        $instance->setKey($key);

        return $instance;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    private function setKey($key)
    {
        $this->key = $key;
    }
}
