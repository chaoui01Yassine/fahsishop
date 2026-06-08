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

namespace PrestaShop\PrestaShop\Adapter\Cache\Clearer;

use AppKernel;
use Exception;
use Hook;
use PrestaShop\PrestaShop\Core\Cache\Clearer\CacheClearerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class SymfonyCacheClearer clears Symfony cache directly from filesystem.
 *
 * @internal
 */
final class SymfonyCacheClearer implements CacheClearerInterface
{
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        /* @var AppKernel */
        global $kernel;
        if (!$kernel) {
            return;
        }

        $cacheClearLocked = $kernel->locksCacheClear();
        if (false === $cacheClearLocked) {
            // The lock was not possible for some reason we should exit
            return;
        }

        // If we reach here it means the clear lock file is locked, we register a shutdown function that will clear the cache once
        // the current process is over.
        register_shutdown_function(function () use ($kernel) {
            try {
                $cacheDir = $kernel->getCacheDir();
                if (!file_exists($cacheDir)) {
                    $kernel->unlocksCacheClear();

                    return;
                }

                $environments = ['prod', 'dev'];
                foreach ($environments as $environment) {
                    try {
                        $application = new Application($kernel);
                        $application->setAutoExit(false);

                        // Clear cache without warmup to be fast
                        $input = new ArrayInput([
                            'command' => 'cache:clear',
                            '--no-warmup' => true,
                            '--env' => $environment,
                        ]);

                        $output = new NullOutput();
                        $application->doRun($input, $output);
                    } catch (Exception $e) {
                        // Do nothing but at least does not break the loop nor function
                    }
                }

                // Warmup prod environment only (not needed for dev since many things are dynamic)
                $application = new Application($kernel);
                $application->setAutoExit(false);
                $input = new ArrayInput([
                    'command' => 'cache:warmup',
                    '--no-optional-warmers' => true,
                    '--env' => 'prod',
                    '--no-debug' => true,
                ]);

                $output = new NullOutput();
                $application->doRun($input, $output);
            } finally {
                Hook::exec('actionClearSf2Cache');
                $kernel->unlocksCacheClear();
            }
        });
    }
}
