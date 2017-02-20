{if $show_refund}
    <div class="hidden orders-right-pane form-horizontal" title="{__("addons.rus_payments.refund")}" id="rus_payments_refund_dialog">
        <form action="{""|fn_url}" method="post" class="rus-payments-refund-form cm-form-dialog-closer" name="refund_form">
            <input type="hidden" name="refund_data[order_id]" value="{$order_info.order_id}" />
            <div class="control-group">
                <label class="control-label" for="rus_payments_refund_amount">{__("addons.rus_payments.amount")} ({$currencies.$primary_currency.symbol nofilter})</label>
                <div class="controls">
                    <input type="text" name="refund_data[amount]" id="rus_payments_refund_amount" class="input-small" value="{$order_info.total|default:"0.00"|fn_format_price:$primary_currency:null:false}" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="rus_payments_refund_cause">{__("addons.rus_payments.cause")}</label>
                <div class="controls">
                    <textarea name="refund_data[cause]" cols="55" rows="3" id="rus_payments_refund_cause"></textarea>
                </div>
            </div>
            <div class="buttons-container">
                <a class="cm-dialog-closer cm-cancel tool-link btn">{__("cancel")}</a>
                {include file="buttons/button.tpl" but_text=__("refund") but_meta="" but_name="dispatch[orders.rus_payments_refund]" but_role="button_main"}
            </div>
        </form>
    <!--rus_payments_refund_dialog--></div>
{/if}