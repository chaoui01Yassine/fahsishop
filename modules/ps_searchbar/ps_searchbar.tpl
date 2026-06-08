{**
 * 2007-2020 fahsishop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to https://fahsishop.com for more information.
 *
 * @author    fahsishop <contact@fahsishop.com>
 * @copyright 2007-2020 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of fahsishop
 *}

<div id="search_widget" class="search-widgets" data-search-controller-url="{$search_controller_url}">
  <form method="get" action="{$search_controller_url}">
    <input type="hidden" name="controller" value="search">
    <i class="material-icons search" aria-hidden="true">search</i>
    <input type="text" name="s" value="{$search_string}" placeholder="{l s='Search our catalog' d='Shop.Theme.Catalog'}" aria-label="{l s='Search' d='Shop.Theme.Catalog'}">
    <i class="material-icons clear" aria-hidden="true">clear</i>
  </form>
</div>
