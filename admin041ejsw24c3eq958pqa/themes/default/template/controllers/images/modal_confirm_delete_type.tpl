{**
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
 *}
<div class="modal-body">
  <div class="form-group">
    {l
      s="If you delete this image format, the theme won't be able to use it anymore. This will result in a degraded experience on your front office."
      d="Admin.Design.Notification"
    }
  </div>

  <div class="modal-checkbox">
    <input type="checkbox" id="delete_linked_images" name="delete">
    <label for="delete_linked_images">{l s="Delete the images linked to this image setting" d="Admin.Design.Notification"}</label>
  </div>
</div>
