<fieldset>
    {if $code == 'ems'}

        <div class="control-group">
            <label class="control-label" for="ship_ems_mode">{__("ems_mode")}</label>
            <div class="controls">
                <select id="ship_ems_mode" name="shipping_data[service_params][mode]">
                    <option value="regions" {if $shipping.service_params.mode == "regions"}selected="selected"{/if}>{__("ems_region")}</option>
                    <option value="cities" {if $shipping.service_params.mode == "cities"}selected="selected"{/if}>{__("ems_city")}</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_ems_delivery_time_plus">{__("ems_delivery_time_plus")}</label>
            <div class="controls">
                <input id="ship_ems_delivery_time_plus" type="text" name="shipping_data[service_params][delivery_time_plus]" size="30" value="{$shipping.service_params.delivery_time_plus}" />
            </div>
        </div>

    {elseif $code == 'russian_pochta'}

        <div class="control-group">
            <label for="ship_russian_post_sending_type" class="control-label">{__("shipping.russianpost.russian_post_sending_type")}:</label>
            <div class="controls">
                <select id="ship_russian_post_sending_type" name="shipping_data[service_params][sending_type]">
                    {foreach from=$sending_type item="s_type" key="k_type"}
                        <option value={$k_type} {if $shipping.service_params.sending_type == $k_type}selected="selected"{/if}>{$s_type}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="control-group">
            <label for="ship_russian_post_sending_categories" class="control-label">{__("shipping.russianpost.russian_post_sending_categories")}:</label>
            <div class="controls">
                <select id="ship_russian_post_sending_categories" name="shipping_data[service_params][sending_category]">
                    {foreach from=$sending_categories item="s_categories" key="k_categories"}
                        <option value={$k_categories} {if $shipping.service_params.sending_category == $k_categories}selected="selected"{/if}>{$s_categories}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="control-group">
            <label for="ship_russian_post_shipping_option" class="control-label">{__("shipping.russianpost.russian_post_shipping_option")}:</label>
            <div class="controls">
                <select id="ship_russian_post_shipping_option" name="shipping_data[service_params][isavia]">
                    <option value="0" {if $shipping.service_params.isavia == "0"}selected="selected"{/if}>{__("addons.rus_russianpost.ground")}</option>
                    <option value="1" {if $shipping.service_params.isavia == "1"}selected="selected"{/if}>{__("addons.rus_russianpost.avia_possible")}</option>
                    <option value="2" {if $shipping.service_params.isavia == "2"}selected="selected"{/if}>{__("addons.rus_russianpost.avia")}</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_delivery">{__("shipping.russianpost.russian_post_cash_on_delivery")}:</label>
            <div class="controls">
                <input id="ship_russian_post_delivery" type="text" name="shipping_data[service_params][cash_on_delivery]" size="30" value="{$shipping.service_params.cash_on_delivery}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_delivery_notice">{__("shipping.russianpost.russian_post_delivery_notice")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][delivery_notice]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][delivery_notice]" value="1" {if $shipping.service_params.services.delivery_notice == "1"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_delivery_notice">{__("addons.rus_russianpost.registered_delivery_notice")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][registered_notice]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][registered_notice]" value="2" {if $shipping.service_params.services.registered_notice == "2"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_inventory">{__("shipping.russianpost.russian_post_shipping_inventory")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][inventory]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][inventory]" value="3" {if $shipping.service_params.services.inventory == "3"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_careful">{__("shipping.russianpost.russian_post_shipping_careful")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][careful]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][careful]" value="4" {if $shipping.service_params.services.careful == "4"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_ponderous">{__("shipping.russianpost.cumbersome_parcel")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][ponderous_parcel]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][ponderous_parcel]" value="6" {if $shipping.service_params.services.ponderous_parcel == "6"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_delivery_courier">{__("shipping.russianpost.delivery_courier")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][delivery_courier]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][delivery_courier]" value="7" {if $shipping.service_params.services.delivery_courier == "7"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_delivery_product">{__("shipping.russianpost.delivery_product")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][delivery_product]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][delivery_product]" value="10" {if $shipping.service_params.services.delivery_product == "10"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_oversize">{__("shipping.russianpost.oversize")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][oversize]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][oversize]" value="12" {if $shipping.service_params.services.oversize == "12"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_insurance">{__("shipping.russianpost.russian_post_shipping_insurance")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][insurance]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][insurance]" value="14" {if $shipping.service_params.services.insurance == "14"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_cash_sender">{__("shipping.russianpost.cash_sender")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][cash_sender]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][cash_sender]" value="24" {if $shipping.service_params.services.cash_sender == "24"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_sms_receipt">{__("shipping.russianpost.sms_receipt")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][sms_receipt]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][sms_receipt]" value="20" {if $shipping.service_params.services.sms_receipt == "20"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_sms_delivery">{__("shipping.russianpost.sms_delivery")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][sms_delivery]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][sms_delivery]" value="21" {if $shipping.service_params.services.sms_delivery == "21"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_check_investment">{__("shipping.russianpost.check_investment")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][check_investment]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][check_investment]" value="22" {if $shipping.service_params.services.check_investment == "22"}checked="checked"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_compliance_investment">{__("shipping.russianpost.compliance_investment")}:</label>
            <div class="controls">
                <input type="hidden" name="shipping_data[service_params][services][compliance_investment]" value="N" />
                <input type="checkbox" name="shipping_data[service_params][services][compliance_investment]" value="23" {if $shipping.service_params.services.compliance_investment == "23"}checked="checked"{/if} />
            </div>
        </div>

    {include file="common/subheader.tpl" title=__("shippings.russianpost.data_tracking")}

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_login">{__("shipping.russianpost.russian_post_login")}:</label>
            <div class="controls">
                <input id="ship_russian_post_login" type="text" name="shipping_data[service_params][api_login]" size="30" value="{$shipping.service_params.api_login}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ship_russian_post_password">{__("shipping.russianpost.russian_post_password")}:</label>
            <div class="controls">
                <input id="ship_russian_post_password" type="text" name="shipping_data[service_params][api_password]" size="30" value="{$shipping.service_params.api_password}" />
            </div>
        </div>

    {elseif $code == 'russian_post_calc'}

        <div class="control-group">
            <label class="control-label" for="user_key">{__("authentication_key")}</label>
            <div class="controls">
                <input id="user_key" type="text" name="shipping_data[service_params][user_key]" size="30" value="{$shipping.service_params.user_key}"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="user_key_password">{__("authentication_password")}</label>
            <div class="controls">
                <input id="user_key_password" type="password" name="shipping_data[service_params][user_key_password]" size="30" value="{$shipping.service_params.user_key_password}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="package_type">{__("russianpost_shipping_type")}</label>
            <div class="controls">
                <select id="package_type" name="shipping_data[service_params][shipping_type]">
                    <option value="rp_main" {if $shipping.service_params.shipping_type == "rp_main"}selected="selected"{/if}>{__("ship_russianpost_shipping_type_rp_main")}</option>
                    <option value="rp_1class" {if $shipping.service_params.shipping_type == "rp_1class"}selected="selected"{/if}>{__("ship_russianpost_shipping_type_rp_1class")}</option>
                </select>
            </div>
        </div>

        <span>{__("ship_russianpost_register_text")}</span>
    {/if}

</fieldset>

{if $code == 'russian_post'}
<script type="text/javascript">
//<![CDATA[
var elm = Tygh.$('#ship_russian_post_shipping_type');
fn_disable_rupost_package_type(elm);
elm.on('change', function(e) {$ldelim}
    fn_disable_rupost_package_type(Tygh.$(this));
{$rdelim});
function fn_disable_rupost_package_type(elm) {$ldelim}
    if (elm.val() == 'air') {$ldelim}
        Tygh.$('#ship_russian_post_package_type').find('[value="cen_band"],[value="cen_pos"]').attr('disabled', 'disabled');
    {$rdelim} else {$ldelim}
        Tygh.$('#ship_russian_post_package_type').find('[value="cen_band"],[value="cen_pos"]').removeAttr('disabled');
    {$rdelim}
{$rdelim}
//]]>
</script>
{/if}
