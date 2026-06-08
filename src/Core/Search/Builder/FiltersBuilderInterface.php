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

namespace PrestaShop\PrestaShop\Core\Search\Builder;

use PrestaShop\PrestaShop\Core\Search\Filters;

/**
 * Interface for filters builders, each builder needs a config which is provided
 * through the setConfig method which MUST be called before calling buildFilters.
 *
 * As the builders are called one after the other they may be provided with an
 * existing filters instance that they need to override, if not they simply create
 * a new Filters instance.
 */
interface FiltersBuilderInterface
{
    public const FILTER_TYPES = [
        'limit',
        'offset',
        'orderBy',
        'sortOrder',
        'filters',
    ];

    /**
     * Allows to set a config through an associative array, this method should
     * be called before buildFilters, it returns the builder for convenience so
     * you can chain both calls (e.g: $builder->setConfig($config)->buildFilters())
     *
     * @param array $config
     *
     * @return $this
     */
    public function setConfig(array $config);

    /**
     * This method is called to build the filters, the filters parameter is used if
     * you want to override a pre existing filter. All builders should keep that in
     * mind as they can be used consecutively with other builders and must not drop
     * existing values carelessly.
     *
     * @param Filters|null $filters
     *
     * @return Filters
     */
    public function buildFilters(Filters $filters = null);
}
