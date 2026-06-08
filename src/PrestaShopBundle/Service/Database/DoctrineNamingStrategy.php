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

namespace PrestaShopBundle\Service\Database;

use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

/**
 * Naming strategy for Doctrine ORM to use prefixed database table names.
 */
class DoctrineNamingStrategy extends UnderscoreNamingStrategy
{
    private $prefix;

    /**
     * Constructor.
     *
     * Prefix is given by injection, set in app/config/parameters.yml.
     *
     * @param string $prefix
     */
    public function __construct($prefix = 'ps_')
    {
        parent::__construct(CASE_LOWER, true);
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     *
     * This override adds a prefix to the underscored table name.
     */
    public function classToTableName($className)
    {
        $underscored = parent::classToTableName($className);

        return $this->prefix . $underscored;
    }

    /**
     * {@inheritdoc}
     *
     * This override adds a prefix to the underscored table name.
     */
    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null)
    {
        return $this->prefix . parent::classToTableName($sourceEntity) . '_' . parent::classToTableName($targetEntity);
    }
}
