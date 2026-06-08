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
<div class="col-4">
  <table class="table table-condensed">
    <tr>
      <td>fahsishop Version</td>
      <td>{$configuration.psVersion}</td>
    </tr>
    <tr>
      <td>PHP Version</td>
      <td>{$configuration.phpVersion}</td>
    </tr>
    <tr>
      <td>MySQL Version</td>
      <td>{$configuration.mysqlVersion}</td>
    </tr>
    <tr>
      <td>Memory Limit</td>
      <td>{$configuration.memoryLimit}</td>
    </tr>
    <tr>
      <td>Max Execution Time</td>
      <td>{$configuration.maxExecutionTime}s</td>
    </tr>
    <tr>
      <td>Smarty Cache</td>
      <td>
        {if $configuration.smartyCache}
          <span class="success">enabled</span>
        {else}
          <span class="error">disabled</span>
        {/if}
      </td>
    </tr>
    <tr>
      <td>Smarty Compilation</td>
      <td>
      {if $configuration.smartyCompilation == 0}
        <span class="success">never recompile</span>
      {elseif $configuration.smartyCompilation == 1}
        <span class="warning">auto</span>
      {else}
        <span class="red">force compile</span>
      {/if}
      </td>
    </tr>
  </table>
</div>
