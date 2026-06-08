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

{if $nb_comments != 0}
  <script type="text/javascript">    
    $('#product-quickview-{$product.id}').insertAfter($('.quickview #product-description-short'));
    $('#product-quickview-{$product.id} .grade-stars').rating({ grade: {$average_grade} });
    $('#product-quickview-{$product.id} .comments-nb').html('({$nb_comments})');
  </script>

  <div id="product-quickview-{$product.id}" class="product-quickview-review">
    <div class="grade-stars"></div>
    <div class="comments-nb"></div>
  </div>
</div>
{/if}
