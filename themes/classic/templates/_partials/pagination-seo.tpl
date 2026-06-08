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

{if isset($listing.pagination) && $listing.pagination.should_be_displayed}
    {$page_nb = 1}
    {if isset($smarty.get.page)}
        {$page_nb = $smarty.get.page|intval|default:1}
    {/if}
    {$queryPage = '?page='|cat:$page_nb}
    {$page.canonical = $page.canonical|replace:$queryPage:''}

    {$prev = false}
    {$next = false}
    {if ($page_nb - 1) == 1}
        {$prev = $page.canonical}
    {elseif $page_nb > 2}
        {$prev = ($page['canonical']|cat:'?page='|cat:($page_nb - 1))}
    {/if}
    {if $listing.pagination.total_items > $listing.pagination.items_shown_to}
        {$next = ($page['canonical']|cat:'?page='|cat:($page_nb + 1))}
    {/if}

    {if $prev}<link rel="prev" href="{$prev}">{/if}
    {if $next}<link rel="next" href="{$next}">{/if}
{/if}
