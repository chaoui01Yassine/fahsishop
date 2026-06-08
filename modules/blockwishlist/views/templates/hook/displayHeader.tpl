{**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 *}

{if $context === "product"}
  {include file="module:blockwishlist/views/templates/components/modals/add-to-wishlist.tpl" url=$url addUrl=$addUrl newWishlistCTA=$newWishlistCTA}
  {include file="module:blockwishlist/views/templates/components/modals/create.tpl" url=$createUrl}
  {include file="module:blockwishlist/views/templates/components/modals/login.tpl"}
  {include file="module:blockwishlist/views/templates/components/toast.tpl"}
{else}
  {include file="module:blockwishlist/views/templates/components/modals/add-to-wishlist.tpl" url=$url addUrl=$addUrl newWishlistCTA=$newWishlistCTA}
  {include file="module:blockwishlist/views/templates/components/modals/delete.tpl" listUrl=$deleteListUrl productUrl=$deleteProductUrl}
  {include file="module:blockwishlist/views/templates/components/modals/create.tpl" url=$createUrl}
  {include file="module:blockwishlist/views/templates/components/modals/login.tpl"}
  {include file="module:blockwishlist/views/templates/components/toast.tpl"}
{/if}
