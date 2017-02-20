<div class="sidebar-row">
    <h6>{__("search")}</h6>

<form action="{""|fn_url}" name="yandex_delivery_search_form" method="get">

{if $smarty.request.redirect_url}
<input type="hidden" name="redirect_url" value="{$smarty.request.redirect_url}" />
{/if}
{if $selected_section != ""}
<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />
{/if}

{$extra nofilter}

{capture name="simple_search"}
<div class="sidebar-field">
    <label for="elm_cname">{__("customer")}:</label>
    <div class="break">
        <input type="text" name="cname" id="elm_cname" value="{$search.cname}" size="30"/>
    </div>
</div>

<div class="sidebar-field">
    <label for="yd_elm_order_id">{__("order_id")}:</label>
    <input type="text" name="yd_order_id" id="elm_yd_order_id" value="{$search.yd_order_id}" size="15"/>
</div>

<div class="sidebar-field">
    <label for="elm_status">{__("status")}:</label>
    <select name="status" id="status">
        <option value="">--</option>
        {foreach from=$yd_order_statuses key="status" item="data"}
        <option value="{$data.yd_status_code}" {if $search.status == $data.yd_status_code}selected="selected"{/if}>{$data.yd_status_name}</option>
        {/foreach}
    </select>

</div>
{/capture}

{include file="common/advanced_search.tpl" simple_search=$smarty.capture.simple_search dispatch=$dispatch view_type="yandex_delivery"}
</form>

</div>
