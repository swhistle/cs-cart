<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:09:59
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\common\license.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2652858a177e7cfe137-75536958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2563e3a580a1fbe567f2973432f1023eccbc9fb' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\common\\license.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2652858a177e7cfe137-75536958',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'store_mode' => 0,
    'store_mode_license' => 0,
    'store_mode_allowed_number_of_storefronts' => 0,
    'store_mode_number_of_storefronts' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a177e7d31d31_57792065',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a177e7d31d31_57792065')) {function content_58a177e7d31d31_57792065($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('additional_storefront_license_required','text_additional_storefront_license_required','buy_storefront_license'));
?>
<?php if (fn_allowed_for("ULTIMATE")&&$_smarty_tpl->tpl_vars['store_mode']->value!="ultimate") {?>
    <div id="restriction_promo_dialog" title="<?php echo $_smarty_tpl->__("additional_storefront_license_required",array('[product]'=>@constant('PRODUCT_NAME')));?>
" class="hidden cm-dialog-auto-size">
        <div class="restriction-features">
            <?php echo $_smarty_tpl->__("text_additional_storefront_license_required",array("[product]"=>@constant('PRODUCT_NAME'),"[license_number]"=>$_smarty_tpl->tpl_vars['store_mode_license']->value,"[allowed_storefronts]"=>$_smarty_tpl->tpl_vars['store_mode_allowed_number_of_storefronts']->value,"[existing_storefronts]"=>$_smarty_tpl->tpl_vars['store_mode_number_of_storefronts']->value));?>

        </div>
        <div class="center">
            <a class="restriction-update-btn" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['resources']['storefront_license_url'], ENT_QUOTES, 'UTF-8');?>
" target="_blank">
                <?php echo $_smarty_tpl->__("buy_storefront_license",array("[product]"=>@constant('PRODUCT_NAME')));?>

            </a>
        </div>
    </div>
<?php }?><?php }} ?>
