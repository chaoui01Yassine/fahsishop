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

{if $nb_comments != 0 || $post_allowed}
<div class="product-comments-additional-info">
  {if $nb_comments == 0}
    {if $post_allowed}
      <button class="btn btn-comment post-product-comment">
        <i class="material-icons edit" data-icon="edit"></i>
        {l s='Write your review' d='Modules.Productcomments.Shop'}
      </button>
    {/if}
  {else}
    {include file='module:productcomments/views/templates/hook/average-grade-stars.tpl' grade=$average_grade}
    <div class="additional-links">
      <a class="link-comment" href="#product-comments-list-header">
        <i class="material-icons chat" data-icon="chat"></i>
        {l s='Read user reviews' d='Modules.Productcomments.Shop'} ({$nb_comments})
      </a>
      {if $post_allowed}
        <a class="link-comment post-product-comment" href="#product-comments-list-header">
          <i class="material-icons edit" data-icon="edit"></i>
          {l s='Write your review' d='Modules.Productcomments.Shop'}
        </a>
      {/if}
    </div>
  {/if}
</div>
{/if}
