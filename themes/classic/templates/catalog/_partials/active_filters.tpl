{**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<section id="js-active-search-filters" class="{if $activeFilters|count}active_filters{else}hide{/if}">
  {block name='active_filters_title'}
    <h1 class="h6 {if $activeFilters|count}active-filter-title{else}hidden-xs-up{/if}">{l s='Active filters' d='Shop.Theme.Global'}</h1>
  {/block}

  {if $activeFilters|count}
    <ul>
      {foreach from=$activeFilters item="filter"}
        {block name='active_filters_item'}
          <li class="filter-block">
            {l s='%1$s:' d='Shop.Theme.Catalog' sprintf=[$filter.facetLabel]}
            {$filter.label}
            <a class="js-search-link" href="{$filter.nextEncodedFacetsURL}"><i class="material-icons close">&#xE5CD;</i></a>
          </li>
        {/block}
      {/foreach}
    </ul>
  {/if}
</section>
