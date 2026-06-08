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
{l s='We have logged your return request.' d='Shop.Pdf' pdf='true'}<br />
{l s='Your package must be returned to us within' d='Shop.Pdf' pdf='true'} {$return_nb_days} {l s='days of receiving your order.' d='Shop.Pdf' pdf='true'}<br /><br />

<table id="summary-tab" width="100%">
	<tr>
		<th class="header small" valign="middle">{l s='Return Number' d='Shop.Pdf' pdf='true'}</th>
		<th class="header small" valign="middle">{l s='Date' d='Shop.Pdf' pdf='true'}</th>
	</tr>
	<tr>
		<td class="center small white">{sprintf('%06d', $order_return->id)}</td>
		<td class="center small white">{dateFormat date=$order_return->date_add full=0}</td>
	</tr>
</table>
