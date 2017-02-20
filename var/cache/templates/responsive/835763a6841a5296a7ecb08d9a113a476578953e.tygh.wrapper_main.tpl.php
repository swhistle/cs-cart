<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:27:28
         compiled from "D:\OpenServer\domains\cs-cart\design\themes\responsive\templates\addons\my_design\blocks\wrappers\wrapper_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:226758a17c00efa5f6-92295052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '835763a6841a5296a7ecb08d9a113a476578953e' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\themes\\responsive\\templates\\addons\\my_design\\blocks\\wrappers\\wrapper_main.tpl',
      1 => 1486723080,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '226758a17c00efa5f6-92295052',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'content' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a17c0100e752_60321006',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a17c0100e752_60321006')) {function content_58a17c0100e752_60321006($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if (trim($_smarty_tpl->tpl_vars['content']->value)) {?>
	<?php $_smarty_tpl->_capture_stack[0][] = array("text_banner_move", null, null); ob_start(); ?>
		<div class="banner-main">
			<div class="container-fluid">
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

			</div>
		</div>
	<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/my_design/blocks/wrappers/wrapper_main.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/my_design/blocks/wrappers/wrapper_main.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if (trim($_smarty_tpl->tpl_vars['content']->value)) {?>
	<?php $_smarty_tpl->_capture_stack[0][] = array("text_banner_move", null, null); ob_start(); ?>
		<div class="banner-main">
			<div class="container-fluid">
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

			</div>
		</div>
	<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }
}?><?php }} ?>
