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

namespace PrestaShopBundle\Install;

use NullLogger;
use PrestaShopLoggerInterface;

abstract class AbstractInstall
{
    /**
     * @var LanguageList
     */
    public $language;

    /**
     * @var \PrestaShopBundle\Translation\Translator
     */
    public $translator;

    /**
     * @var array List of errors
     */
    protected $errors = [];

    /**
     * @var PrestaShopLoggerInterface
     */
    protected $logger;

    public function __construct()
    {
        $this->language = LanguageList::getInstance();
    }

    public function setError($errors)
    {
        if (!is_array($errors)) {
            $errors = [$errors];
        }

        $this->errors = array_merge($this->errors, $errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * @return PrestaShopLoggerInterface;
     */
    public function getLogger(): PrestaShopLoggerInterface
    {
        if (null === $this->logger) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }

    /**
     * @param PrestaShopLoggerInterface $logger
     */
    public function setLogger(PrestaShopLoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
