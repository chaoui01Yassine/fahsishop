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

namespace PrestaShop\PrestaShop\Adapter\Shop\Url;

use PrestaShop\PrestaShop\Adapter\LegacyContext;
use PrestaShop\PrestaShop\Core\Help\Documentation;
use PrestaShop\PrestaShop\Core\Shop\Url\UrlProviderInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Generates the help url which is used most in the help sidebar component.
 */
class HelpProvider implements UrlProviderInterface
{
    /**
     * @var LegacyContext
     */
    private $legacyContext;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var Documentation
     */
    private $documentation;

    public function __construct(
        LegacyContext $legacyContext,
        TranslatorInterface $translator,
        RouterInterface $router,
        Documentation $documentation
    ) {
        $this->legacyContext = $legacyContext;
        $this->translator = $translator;
        $this->router = $router;
        $this->documentation = $documentation;
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl(string $section = '', string $title = '')
    {
        if (empty($title)) {
            $title = $this->translator->trans('Help', [], 'Admin.Global');
        }

        return $this->router->generate('admin_common_sidebar', [
            'url' => $this->documentation->generateLink($section, $this->legacyContext->getEmployeeLanguageIso()),
            'title' => $title,
        ]);
    }
}
