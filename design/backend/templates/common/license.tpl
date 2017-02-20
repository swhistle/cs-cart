{if "ULTIMATE"|fn_allowed_for && $store_mode != "ultimate"}
    <div id="restriction_promo_dialog" title="{__("additional_storefront_license_required", ['[product]' => $smarty.const.PRODUCT_NAME])}" class="hidden cm-dialog-auto-size">
        <div class="restriction-features">
            {__("text_additional_storefront_license_required", [
                "[product]" => $smarty.const.PRODUCT_NAME,
                "[license_number]" => $store_mode_license,
                "[allowed_storefronts]" => $store_mode_allowed_number_of_storefronts,
                "[existing_storefronts]" => $store_mode_number_of_storefronts
            ])}
        </div>
        <div class="center">
            <a class="restriction-update-btn" href="{$config.resources.storefront_license_url}" target="_blank">
                {__("buy_storefront_license", [
                    "[product]" => $smarty.const.PRODUCT_NAME
                ])}
            </a>
        </div>
    </div>
{/if}