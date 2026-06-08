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

<div>
  <h4>
    {if $display_link_supplier}<a href="{$page_link}" title="{l s='Suppliers' d='Modules.Supplierlist.Shop'}">{/if}
      {l s='Suppliers' d='Modules.Supplierlist.Shop'}
      {if $display_link_supplier}</a>{/if}
  </h4>
  <div>
    {if $suppliers}
      {include file="module:ps_supplierlist/views/templates/_partials/$supplier_display_type.tpl" suppliers=$suppliers}
    {else}
      <p>{l s='No supplier' d='Modules.Supplierlist.Shop'}</p>
    {/if}
  </div>
</div>
