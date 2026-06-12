{block name='product_miniature_item'}
<div class="js-product product{if !empty($productClasses)} {$productClasses}{/if}">
  <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}">

    <div class="pm-img-wrap">
      {block name='product_thumbnail'}
        <a href="{$product.url}" class="pm-img-link" tabindex="-1" aria-label="{$product.name|truncate:30:'...'}">
          {if $product.cover}
            <picture>
              {if !empty($product.cover.bySize.home_default.sources.avif)}<source srcset="{$product.cover.bySize.home_default.sources.avif}" type="image/avif">{/if}
              {if !empty($product.cover.bySize.home_default.sources.webp)}<source srcset="{$product.cover.bySize.home_default.sources.webp}" type="image/webp">{/if}
              <img class="pm-img"
                src="{$product.cover.bySize.home_default.url}"
                alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                loading="lazy"
                data-full-size-image-url="{$product.cover.large.url}"
              />
            </picture>
          {else}
            <picture>
              {if !empty($urls.no_picture_image.bySize.home_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.home_default.sources.avif}" type="image/avif">{/if}
              {if !empty($urls.no_picture_image.bySize.home_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.home_default.sources.webp}" type="image/webp">{/if}
              <img class="pm-img" src="{$urls.no_picture_image.bySize.home_default.url}" loading="lazy" />
            </picture>
          {/if}
        </a>
      {/block}

      {* Badges (new, sale, etc.) *}
      {include file='catalog/_partials/product-flags.tpl'}

      {* Quick view + wishlist *}
      <div class="pm-actions">
        {block name='quick_view'}
          <button class="pm-action-btn js-quick-view" data-link-action="quickview" title="{l s='Quick view' d='Shop.Theme.Actions'}">
            <i class="material-icons">search</i>
          </button>
        {/block}
        {hook h='displayWishlistButton' product=$product}
      </div>

      {* Variants on hover *}
      {block name='product_variants'}
        {if $product.main_variants}
          <div class="pm-variants">
            {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
          </div>
        {/if}
      {/block}
    </div>

    <div class="pm-info">
      {block name='product_name'}
        {if $page.page_name == 'index'}
          <h3 class="pm-title"><a href="{$product.url}">{$product.name|truncate:55:'...'}</a></h3>
        {else}
          <h2 class="pm-title h3"><a href="{$product.url}">{$product.name|truncate:55:'...'}</a></h2>
        {/if}
      {/block}

      {block name='product_price_and_shipping'}
        {if $product.show_price}
          <div class="pm-price-row">
            {if $product.has_discount}
              <span class="pm-price-old">{$product.regular_price}</span>
              {if $product.discount_type === 'percentage'}
                <span class="pm-discount-badge">{$product.discount_percentage}</span>
              {elseif $product.discount_type === 'amount'}
                <span class="pm-discount-badge">{$product.discount_amount_to_display}</span>
              {/if}
            {/if}
            <span class="pm-price">
              {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
              {if '' !== $smarty.capture.custom_price}{$smarty.capture.custom_price nofilter}{else}{$product.price}{/if}
            </span>
          </div>
        {/if}
      {/block}

      {block name='product_reviews'}
        {hook h='displayProductListReviews' product=$product}
      {/block}

      <a href="{$product.url}" class="pm-add-to-cart">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        {l s='Add to cart' d='Shop.Theme.Actions'}
      </a>
    </div>

  </article>
</div>
{/block}
