{**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
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
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *}
<table style="width: 100%;">
	<tr>
		<td style="text-align: left; font-size: 6pt; color: #444; width:87%;">
			{$shop_address|escape:'html':'UTF-8'}<br />

			{if !empty($shop_phone) OR !empty($shop_fax)}
				{l s='For more assistance, contact Support:' d='Shop.Pdf' pdf='true'}<br />
				{if !empty($shop_phone)}
					{l s='Tel: %s' sprintf=[$shop_phone|escape:'html':'UTF-8'] d='Shop.Pdf' pdf='true'}
				{/if}

				{if !empty($shop_fax)}
					{l s='Fax: %s' sprintf=[$shop_fax|escape:'html':'UTF-8'] d='Shop.Pdf' pdf='true'}
				{/if}
				<br />
			{/if}

			{if isset($shop_details)}
				{$shop_details|escape:'html':'UTF-8'}<br />
			{/if}

			{if isset($free_text)}
				{foreach $free_text as $text}
					{$text|escape:'html':'UTF-8'}<br />
				{/foreach}
			{/if}
		</td>
		<td style="text-align: right; font-size: 8pt; color: #444;  width:13%;">
            {literal}{:pnp:} / {:ptp:}{/literal}
        </td>
	</tr>
</table>

