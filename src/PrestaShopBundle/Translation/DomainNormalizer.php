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

namespace PrestaShopBundle\Translation;

use RuntimeException;

/**
 * Normalizes domain names by removing dots
 */
class DomainNormalizer
{
    /**
     * @param string $domain Domain name
     *
     * @return string
     *
     * @throws RuntimeException
     */
    public function normalize($domain)
    {
        // remove up to two dots from the domain name
        // (because legacy domain translations CAN have dots in the third part)
        $normalizedDomain = preg_replace('/\./', '', $domain, 2);

        if ($normalizedDomain === null) {
            throw new RuntimeException(sprintf('An error occurred while normalizing domain "%s"', $domain));
        }

        return $normalizedDomain;
    }
}
