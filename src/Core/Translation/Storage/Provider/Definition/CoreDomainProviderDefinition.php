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

namespace PrestaShop\PrestaShop\Core\Translation\Storage\Provider\Definition;

/**
 * Properties container for core translation provider filtering by a single domain name.
 */
class CoreDomainProviderDefinition extends AbstractCoreProviderDefinition
{
    private const FILENAME_FILTERS_REGEX = [
        '#^%s([A-Za-z]|\.|$)#',
    ];
    private const TRANSLATION_DOMAINS_REGEX = [
        '^%s([A-Za-z]|$)',
    ];

    /**
     * @var string
     */
    private $domainName;

    /**
     * @param string $domainName
     */
    public function __construct(string $domainName)
    {
        $this->domainName = $domainName;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return ProviderDefinitionInterface::TYPE_CORE_DOMAIN;
    }

    /**
     * @return string
     */
    public function getDomainName(): string
    {
        return $this->domainName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilenameFilters(): array
    {
        return array_map(function (string $filenameFilter) {
            return sprintf($filenameFilter, preg_quote($this->domainName, '#'));
        }, self::FILENAME_FILTERS_REGEX);
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslationDomains(): array
    {
        return array_map(function (string $translationDomain) {
            return sprintf($translationDomain, preg_quote($this->domainName, '#'));
        }, self::TRANSLATION_DOMAINS_REGEX);
    }
}
