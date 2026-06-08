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

namespace PrestaShopBundle\Service\Routing;

use PrestaShop\PrestaShop\Core\Feature\TokenInUrls;
use PrestaShopBundle\Service\DataProvider\UserProvider;
use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

/**
 * We extends Symfony Router in order to add a token to each url.
 *
 * This is done for Security purposes.
 */
class Router extends BaseRouter
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    /**
     * @var CsrfTokenManager
     */
    private $tokenManager;

    /**
     * @var array
     */
    private $tokens = [];

    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $username = $this->userProvider->getUsername();
        // Do not generate token each time we want to generate a route for a user
        if (!isset($this->tokens[$username])) {
            $this->tokens[$username] = $this->tokenManager->getToken($username)->getValue();
        }

        $url = parent::generate($name, $parameters, $referenceType);

        if (TokenInUrls::isDisabled()) {
            return $url;
        }

        return self::generateTokenizedUrl($url, $this->tokens[$username]);
    }

    public function setTokenManager(CsrfTokenManager $tokenManager)
    {
        $this->tokenManager = $tokenManager;
    }

    public function setUserProvider(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public static function generateTokenizedUrl($url, $token)
    {
        $components = parse_url($url);
        $baseUrl = (isset($components['path']) ? $components['path'] : '');
        $queryParams = [];
        if (isset($components['query'])) {
            $query = $components['query'];

            parse_str($query, $queryParams);
        }

        $queryParams['_token'] = $token;

        $url = $baseUrl . '?' . http_build_query($queryParams, '', '&');
        if (isset($components['fragment']) && $components['fragment'] !== '') {
            /* This copy-paste from Symfony's UrlGenerator */
            $url .= '#' . strtr(rawurlencode($components['fragment']), ['%2F' => '/', '%3F' => '?']);
        }

        return $url;
    }
}
