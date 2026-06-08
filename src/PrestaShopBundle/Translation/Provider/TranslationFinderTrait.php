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

namespace PrestaShopBundle\Translation\Provider;

use PrestaShop\PrestaShop\Core\Exception\FileNotFoundException;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * Helper used to retrieve a Symfony Catalogue object.
 *
 * @deprecated use TraslationFinder instead
 */
trait TranslationFinderTrait
{
    /**
     * @param array $paths a list of paths when we can look for translations
     * @param string $locale the Symfony (not the fahsishop one) locale
     * @param string|null $pattern a regular expression
     *
     * @return MessageCatalogue
     *
     * @throws FileNotFoundException
     *
     * @deprecated use TraslationFinder::getCatalogueFromPaths() instead
     */
    public function getCatalogueFromPaths($paths, $locale, $pattern = null)
    {
        @trigger_error(
            __FUNCTION__ . 'is deprecated since version 1.7.6.1 Use TranslationFinder::getCatalogueFromPaths() instead.',
            E_USER_DEPRECATED
        );

        return (new TranslationFinder())->getCatalogueFromPaths($paths, $locale, $pattern);
    }
}
