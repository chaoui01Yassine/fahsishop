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

use PrestaShop\Autoload\PrestashopAutoload;
use PrestaShop\PrestaShop\Core\Version;

require_once __DIR__ . '/../vendor/autoload.php';

define('_PS_VERSION_', Version::VERSION);

// ── Autoloader namespace Fahsishop\ (PSR-4) ──────────────────────────────────
spl_autoload_register(function (string $class): void {
    $prefix = 'Fahsishop\\';
    $baseDir = __DIR__ . '/../src/Fahsishop/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}, true, true); // prepend = true pour priorité maximale

require_once _PS_CONFIG_DIR_ . 'alias.php';

PrestashopAutoload::create(_PS_ROOT_DIR_, _PS_CACHE_DIR_)
    ->register();
