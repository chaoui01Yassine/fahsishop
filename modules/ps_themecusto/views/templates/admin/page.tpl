{*
* 2007-2018 fahsishop
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade fahsishop to newer
* versions in the future. If you wish to customize fahsishop for your
* needs please refer to https://fahsishop.com for more information.
*
* @author    fahsishop <contact@fahsishop.com>
* @copyright 2007-2018 fahsishop
* @license   https://fahsishop.com/en/content/12-terms-and-conditions-of-use
* International Registered Trademark & Property of fahsishop
*}

<div class="content-div">
    <div class="grid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {if $enable}
                {include file="./controllers/$configure_type/index.tpl"}
            {else}
                <div class="panel col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>{l s='The module %s has been disabled' sprintf=$moduleName mod='ps_themecusto'}</h4>
                </div>
            {/if}
        </div>
    </div>
</div>
