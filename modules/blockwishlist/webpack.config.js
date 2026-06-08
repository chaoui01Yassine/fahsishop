/* eslint-disable indent,comma-dangle */
/**
 * 2007-2020 fahsishop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to https://fahsishop.com for more information.
 *
 * @author    fahsishop <contact@fahsishop.com>
 * @copyright 2007-2020 fahsishop and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of fahsishop
 */

/**
 * Three mode available:
 *  build = production mode
 *  dev = development mode
 */
const prod = require('./.webpack/prod.js');
const dev = require('./.webpack/dev.js');

module.exports = (env, argv) => (argv.mode === 'production' ? prod() : dev());
