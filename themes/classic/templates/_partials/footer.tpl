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
<div class="container">
  <div class="row">
    {block name='hook_footer_before'}
      {hook h='displayFooterBefore'}
    {/block}
  </div>
</div>
<div class="footer-container">
  <div class="container">
    <div class="row">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
    </div>
    <div class="row">
      {block name='hook_footer_after'}
        {hook h='displayFooterAfter'}
      {/block}
    </div>
    <div class="row footer-bottom" style="margin-top:30px; padding:16px 0; border-top:1px solid rgba(201,149,42,0.2); text-align:center;">
      <div class="col-md-12">
        {block name='copyright_link'}
          <span style="color:#7A6A5A; font-size:12px; letter-spacing:1px;">
            ✦ &nbsp;
            <strong style="color:#C9952A; font-family:'Playfair Display',serif; font-size:14px;">fahsishop</strong>
            &nbsp;— Vêtements &amp; Artisanat Marocain Traditionnel
            &nbsp; · &nbsp; © {'Y'|date} fahsishop.com
            &nbsp;✦
          </span>
        {/block}
      </div>
    </div>
  </div>
</div>
