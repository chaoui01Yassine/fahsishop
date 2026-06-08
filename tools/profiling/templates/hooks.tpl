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
<div class="col-5">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Hook</th>
        <th>Time</th>
        <th>Memory Usage</th>
      </tr>
    </thead>

    <tbody>
    {foreach $hooks.perfs as $hook => $hooksPerfs}
      <tr>
        <td>
          <a href="javascript:void(0);" onclick="$('.{$hook}_modules_details').toggle();">{$hook}</a>
        </td>
        <td>
          {load_time data=$hooksPerfs['time']}
        </td>
        <td>
          {memory data=$hooksPerfs['memory']}
        </td>
      </tr>

      {foreach $hooksPerfs['modules'] as $perfs}
        <tr class="{$hook}_modules_details" style="background-color:#EFEFEF;display:none">
          <td>
            =&gt; {$perfs['module']}
          </td>
          <td>
            {load_time data=$perfs['time']}
          </td>
          <td>
            {memory data=$perfs['memory']}
          </td>
        </tr>
      {/foreach}
    {/foreach}

    </tbody>
    <tfoot>
      <tr>
        <th><b>{$hooks.perfs|count} hook(s)</b></th>
        <th>{load_time data=$hooks.totalHooksTime}</th>
        <th>{memory data=$hooks.totalHooksMemory}</th>
      </tr>
    </tfoot>
  </table>
</div>
