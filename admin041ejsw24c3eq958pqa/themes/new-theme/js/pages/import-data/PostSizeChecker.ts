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

export default class PostSizeChecker {
  postSizeLimitThreshold: number;

  constructor() {
    // How close can we get to the post size limit. 0.9 means 90%.
    this.postSizeLimitThreshold = 0.9;
  }

  /**
   * Check if given postSizeLimit is reaching the required post size
   *
   * @param {number} postSizeLimit
   * @param {number} requiredPostSize
   *
   * @returns {boolean}
   */
  isReachingPostSizeLimit(
    postSizeLimit: number,
    requiredPostSize: number,
  ): boolean {
    return requiredPostSize >= postSizeLimit * this.postSizeLimitThreshold;
  }

  /**
   * Get required post size in megabytes.
   *
   * @param {number} requiredPostSize
   *
   * @returns {number}
   */
  getRequiredPostSizeInMegabytes(requiredPostSize: number): number {
    const requiredSize = requiredPostSize / (1024 * 1024);

    return parseInt(<string>(<unknown>requiredSize), 10);
  }
}
