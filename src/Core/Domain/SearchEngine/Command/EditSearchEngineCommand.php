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

namespace PrestaShop\PrestaShop\Core\Domain\SearchEngine\Command;

use PrestaShop\PrestaShop\Core\Domain\SearchEngine\Exception\SearchEngineException;
use PrestaShop\PrestaShop\Core\Domain\SearchEngine\ValueObject\SearchEngineId;

/**
 * Edits given search engine with provided data.
 */
class EditSearchEngineCommand
{
    /**
     * @var SearchEngineId
     */
    private $searchEngineId;

    /**
     * @var string|null
     */
    private $server;

    /**
     * @var string|null
     */
    private $queryKey;

    /**
     * @param int $searchEngineId
     *
     * @throws SearchEngineException
     */
    public function __construct(int $searchEngineId)
    {
        $this->searchEngineId = new SearchEngineId($searchEngineId);
    }

    /**
     * @return SearchEngineId
     */
    public function getSearchEngineId(): SearchEngineId
    {
        return $this->searchEngineId;
    }

    /**
     * @return string|null
     */
    public function getServer(): ?string
    {
        return $this->server;
    }

    /**
     * @param string|null $server
     *
     * @return self
     */
    public function setServer(?string $server): self
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getQueryKey(): ?string
    {
        return $this->queryKey;
    }

    /**
     * @param string|null $queryKey
     *
     * @return self
     */
    public function setQueryKey(?string $queryKey): self
    {
        $this->queryKey = $queryKey;

        return $this;
    }
}
