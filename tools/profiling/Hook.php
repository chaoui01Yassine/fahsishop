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

class Hook extends HookCore
{
    public static function coreCallHook($module, $method, $params)
    {
        $timeStart = microtime(true);
        $memoryStart = memory_get_usage();

        $result = parent::coreCallHook($module, $method, $params);

        Profiler::getInstance()->interceptHook(
            substr($method, 4),
            [
                'module' => $module->name,
                'params' => $params,
                'time' => microtime(true) - $timeStart,
                'memory' => memory_get_usage() - $memoryStart,
            ]
        );

        Profiler::getInstance()->interceptModule(
            [
                'module' => $module->name,
                'method' => $method,
                'time' => microtime(true) - $timeStart,
                'memory' => memory_get_usage() - $memoryStart,
            ]
        );

        return $result;
    }

    public static function coreRenderWidget($module, $registeredHookName, $params)
    {
        $timeStart = microtime(true);
        $memoryStart = memory_get_usage();

        $result = parent::coreRenderWidget($module, $registeredHookName, $params);

        /*
         * It's not a hook which has been triggered but
         * it's a widget
         */
        if (empty($registeredHookName)) {
            $registeredHookName = 'renderWidget';
        }

        Profiler::getInstance()->interceptHook(
            $registeredHookName,
            [
                'module' => $module->name . ' (widget)',
                'params' => $params,
                'time' => microtime(true) - $timeStart,
                'memory' => memory_get_usage() - $memoryStart,
            ]
        );

        Profiler::getInstance()->interceptModule(
            [
                'module' => $module->name,
                'method' => $registeredHookName,
                'time' => microtime(true) - $timeStart,
                'memory' => memory_get_usage() - $memoryStart,
            ]
        );

        return $result;
    }
}
