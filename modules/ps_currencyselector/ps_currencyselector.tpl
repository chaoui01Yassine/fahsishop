{*
* 2007-2015 fahsishop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author fahsishop <contact@fahsishop.com>
*  @copyright  2007-2015 fahsishop
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of fahsishop
*}

<div class="currency-selector">
  <span>{$current_currency.iso_code}{if $current_currency.sign !== $current_currency.iso_code} {$current_currency.sign}{/if}</span>
  <ul>
    {foreach from=$currencies item=currency}
      <li {if $currency.current} class="current" {/if}>
        <a rel="nofollow" href="{$currency.url}">{$currency.iso_code}{if $currency.sign !== $currency.iso_code} {$currency.sign}{/if}</a>
      </li>
    {/foreach}
  </ul>
</div>
