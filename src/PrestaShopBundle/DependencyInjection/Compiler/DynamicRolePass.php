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

namespace PrestaShopBundle\DependencyInjection\Compiler;

use PrestaShopBundle\Exception\ServiceDefinitionException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Sets dynamic role hierarchy in the voter.
 */
class DynamicRolePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        /*
         * @see Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension:createRoleHierarchy
         */
        if ($container->hasDefinition('security.access.role_hierarchy_voter')) {
            throw new ServiceDefinitionException('The security.access.role_hierarchy_voter service is already defined', 'security.access.role_hierarchy_voter');
        }

        $roleHierarchyVoterDefinition = $container->register(
            'security.access.role_hierarchy_voter',
            Voter::class
        );

        $roleHierarchyVoterDefinition
            ->setPublic(false)
            ->addArgument(new Reference('prestashop.security.role.dynamic_role_hierarchy'))
            ->addTag('security.voter', ['priority' => 245]);
    }
}
