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
{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
    <div id="subcategories" class="card card-block">
      <h2 class="subcategory-heading">{l s='Subcategories' d='Shop.Theme.Category'}</h2>

      <ul class="subcategories-list">
        {foreach from=$subcategories item=subcategory}
          <li>
            <div class="subcategory-image">
              <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="img">
                {if !empty($subcategory.image.large.url)}
                  <picture>
                    {if !empty($subcategory.image.large.sources.avif)}<source srcset="{$subcategory.image.large.sources.avif}" type="image/avif">{/if}
                    {if !empty($subcategory.image.large.sources.webp)}<source srcset="{$subcategory.image.large.sources.webp}" type="image/webp">{/if}
                    <img
                      class="img-fluid"
                      src="{$subcategory.image.large.url}"
                      alt="{$subcategory.name|escape:'html':'UTF-8'}"
                      loading="lazy"
                      width="{$subcategory.image.large.width}"
                      height="{$subcategory.image.large.height}"/>
                  </picture>
                {/if}
              </a>
            </div>

            <h5>
              <a class="subcategory-name" href="{$subcategory.url}">
                {$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'}
              </a>
            </h5>
            {if $subcategory.description}
              <div class="cat_desc">{$subcategory.description|unescape:'html' nofilter}</div>
            {/if}
          </li>
        {/foreach}
      </ul>
    </div>
  {/if}
{/if}
