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

<div class="product-comment-list-item row" data-product-comment-id="@COMMENT_ID@" data-product-id="@PRODUCT_ID@">
  <div class="col-sm-3 comment-infos">
    <div class="grade-stars" data-grade="@COMMENT_GRADE@"></div>
    <div class="comment-date">
      @COMMENT_DATE@
    </div>
    <div class="comment-author">
      {l s='By %1$s' sprintf=['@CUSTOMER_NAME@'] d='Modules.Productcomments.Shop'}
    </div>
  </div>

  <div class="col-sm-9 comment-content">
    <p class="h4">@COMMENT_TITLE@</p>
    <p>@COMMENT_COMMENT@</p>
    <div class="comment-buttons btn-group">
      {if $usefulness_enabled}
        <a class="useful-review">
          <i class="material-icons thumb_up" data-icon="thumb_up"></i>
          <span class="useful-review-value">@COMMENT_USEFUL_ADVICES@</span>
        </a>
        <a class="not-useful-review">
          <i class="material-icons thumb_down" data-icon="thumb_down"></i>
          <span class="not-useful-review-value">@COMMENT_NOT_USEFUL_ADVICES@</span>
        </a>
      {/if}
      <a class="report-abuse" title="{l s='Report abuse' d='Modules.Productcomments.Shop'}">
        <i class="material-icons flag" data-icon="flag"></i>
      </a>
    </div>
  </div>
</div>
