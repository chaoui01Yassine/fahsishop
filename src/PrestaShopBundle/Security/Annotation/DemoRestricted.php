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

namespace PrestaShopBundle\Security\Annotation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * Forbid access to the page if Demonstration mode is enabled.
 *
 * @Annotation
 */
class DemoRestricted extends ConfigurationAnnotation
{
    /**
     * The translation domain for the message.
     *
     * @var string
     */
    protected $domain = 'Admin.Notifications.Error';

    /**
     * The message of the exception.
     *
     * @var string
     */
    protected $message = 'This functionality has been disabled.';

    /**
     * The route for the redirection.
     *
     * @var string
     */
    protected $redirectRoute;

    /**
     * The route params which are used together to generate the redirect route.
     *
     * @var array
     */
    protected $redirectQueryParamsToKeep = [];

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain the translation domain name
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message the message displayed after redirection
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getRedirectRoute()
    {
        return $this->redirectRoute;
    }

    /**
     * @param string $redirectRoute the route used for redirection
     */
    public function setRedirectRoute($redirectRoute)
    {
        $this->redirectRoute = $redirectRoute;
    }

    /**
     * Returns the alias name for an annotated configuration.
     *
     * @return string
     */
    public function getAliasName()
    {
        return 'demo_restricted';
    }

    /**
     * Returns whether multiple annotations of this type are allowed.
     *
     * @return bool
     */
    public function allowArray()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getRedirectQueryParamsToKeep()
    {
        return $this->redirectQueryParamsToKeep;
    }

    /**
     * @param array $redirectQueryParamsToKeep
     */
    public function setRedirectQueryParamsToKeep($redirectQueryParamsToKeep)
    {
        $this->redirectQueryParamsToKeep = $redirectQueryParamsToKeep;
    }
}
