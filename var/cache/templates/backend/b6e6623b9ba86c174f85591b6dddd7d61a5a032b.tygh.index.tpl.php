<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:09:57
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2301758a177e52b5c61-64822281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6e6623b9ba86c174f85591b6dddd7d61a5a032b' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\index.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2301758a177e52b5c61-64822281',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'language_direction' => 0,
    'page_title' => 0,
    'navigation' => 0,
    'images_dir' => 0,
    'content_tpl' => 0,
    'auth' => 0,
    'view_mode' => 0,
    'content' => 0,
    'stats' => 0,
    'show_sm_dialog' => 0,
    'show_trial_dialog' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a177e53ec781_35275051',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a177e53ec781_35275051')) {function content_58a177e53ec781_35275051($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\block.hook.php';
?><?php
fn_preload_lang_vars(array('admin_panel'));
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language_direction']->value, ENT_QUOTES, 'UTF-8');?>
">

<head>
<title><?php if ($_smarty_tpl->tpl_vars['page_title']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'UTF-8');
} else {
if ($_smarty_tpl->tpl_vars['navigation']->value['selected_tab']) {
echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['navigation']->value['selected_tab']);
if ($_smarty_tpl->tpl_vars['navigation']->value['subsection']) {?> :: <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['navigation']->value['subsection']);
}?> - <?php }
echo $_smarty_tpl->__("admin_panel");
}?></title>
<meta name="viewport" content="width=1240,maximum-scale=1.0" />
<link href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_dir']->value, ENT_QUOTES, 'UTF-8');?>
/favicon.ico" rel="shortcut icon" type="image/x-icon" >
<?php echo $_smarty_tpl->getSubTemplate ("common/styles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if (defined("DEVELOPMENT")&&@constant('DEVELOPMENT')==true) {?>
<?php echo '<script'; ?>
 type="text/javascript" data-no-defer>
window.jsErrors = [];
/*window.onerror = function(errorMessage) {
    document.write('<div data-ca-debug="1" style="border: 2px solid red; margin: 2px;">' + errorMessage + '</div>');
}*/
<?php echo '</script'; ?>
>
<?php }?>
</head>
<?php echo $_smarty_tpl->getSubTemplate ("buttons/helpers.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!--[if lte IE 8 ]><body class="ie8"><![endif]-->
<!--[if lte IE 9 ]><body class="ie9"><![endif]-->
<!--[if !IE]><!--><body><!--<![endif]-->
    <?php echo $_smarty_tpl->getSubTemplate ("common/loading_box.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php if (defined("THEMES_PANEL")) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("demo_theme_selector.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/notification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php $_smarty_tpl->tpl_vars["content"] = new Smarty_variable($_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['content_tpl']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0));?>


    <div class="main-wrap" id="main_column<?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']||$_smarty_tpl->tpl_vars['view_mode']->value=='simple') {?>_login<?php }?>">
    <?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="simple") {?>
        <div class="admin-content">

            <div id="header" class="header">
                <?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <!--header--></div>

            <div class="admin-content-wrap">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:main_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:main_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:main_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                <?php echo (($tmp = @$_smarty_tpl->tpl_vars['stats']->value)===null||$tmp==='' ? '' : $tmp);?>

            </div>

        </div>
        <?php } else { ?>
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    <?php }?>

    <!--main_column<?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']||$_smarty_tpl->tpl_vars['view_mode']->value=='simple') {?>_login<?php }?>--></div>

    <?php echo $_smarty_tpl->getSubTemplate ("common/comet.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    

    <?php if (fn_check_meta_redirect($_REQUEST['meta_redirect_url'])) {?>
        <meta http-equiv="refresh" content="1;url=<?php echo htmlspecialchars(fn_url(fn_check_meta_redirect($_REQUEST['meta_redirect_url'])), ENT_QUOTES, 'UTF-8');?>
" />
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']&&fn_check_permissions('settings','change_store_mode','admin','POST')) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/settings/store_mode.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show'=>$_smarty_tpl->tpl_vars['show_sm_dialog']->value), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("views/settings/trial_expired.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show'=>$_smarty_tpl->tpl_vars['show_trial_dialog']->value), 0);?>

    <?php }?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:after_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:after_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:after_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <?php echo $_smarty_tpl->getSubTemplate ("common/scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html>
<?php }} ?>
