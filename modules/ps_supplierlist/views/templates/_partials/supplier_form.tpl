{*
* 2007-2016 fahsishop
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
*  @copyright  2007-2016 fahsishop
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of fahsishop
*}

<div class="suppliers-sort dropdown">
  <button
    class="btn-unstyle select-title"
    rel="nofollow"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false">
    {l s='All suppliers' d='Modules.Supplierlist.Shop'}
    <i class="material-icons float-xs-right">arrow_drop_down</i>
  </button>
  <div class="dropdown-menu">
    {foreach from=$suppliers item=supplier}
      <a
        rel="nofollow"
        href="{$supplier['link']}"
        class="select-list js-search-link"
      >
        {$supplier['name']}
      </a>
    {/foreach}
  </div>
</div>
