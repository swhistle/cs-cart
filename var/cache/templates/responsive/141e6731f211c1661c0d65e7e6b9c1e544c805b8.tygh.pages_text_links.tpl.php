<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:27:29
         compiled from "D:\OpenServer\domains\cs-cart\design\themes\responsive\templates\blocks\pages\pages_text_links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1605458a17c01131a45-42586564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '141e6731f211c1661c0d65e7e6b9c1e544c805b8' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\themes\\responsive\\templates\\blocks\\pages\\pages_text_links.tpl',
      1 => 1486398744,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1605458a17c01131a45-42586564',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'items' => 0,
    'page' => 0,
    'block' => 0,
    'href' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a17c012c8124_31345199',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a17c012c8124_31345199')) {function content_58a17c012c8124_31345199($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>

<?php if ($_smarty_tpl->tpl_vars['items']->value) {?>
    <ul class="ty-text-links"><?php  $_smarty_tpl->tpl_vars["page"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["page"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["page"]->key => $_smarty_tpl->tpl_vars["page"]->value) {
$_smarty_tpl->tpl_vars["page"]->_loop = true;
?><li class="ty-text-links__item ty-level-<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['page']->value['level'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['page']->value['active']||fn_check_is_active_menu_item($_smarty_tpl->tpl_vars['page']->value,$_smarty_tpl->tpl_vars['block']->value['type'])) {?> ty-text-links__active<?php }?>"><?php if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_LINK')) {
$_smarty_tpl->tpl_vars["href"] = new Smarty_variable(fn_url($_smarty_tpl->tpl_vars['page']->value['link']), null, 0);
} else {
$_smarty_tpl->tpl_vars["href"] = new Smarty_variable(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])), null, 0);
}
$_smarty_tpl->_capture_stack[0][] = array("attributes", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['page']->value['new_window']) {?>class="ty-text-links__a"target="_blank"<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8');?>
" <?php echo Smarty::$_smarty_vars['capture']['attributes'];?>
><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page'], ENT_QUOTES, 'UTF-8');?>
</a></li><?php } ?></ul>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/pages/pages_text_links.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/pages/pages_text_links.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>

<?php if ($_smarty_tpl->tpl_vars['items']->value) {?>
    <ul class="ty-text-links"><?php  $_smarty_tpl->tpl_vars["page"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["page"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["page"]->key => $_smarty_tpl->tpl_vars["page"]->value) {
$_smarty_tpl->tpl_vars["page"]->_loop = true;
?><li class="ty-text-links__item ty-level-<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['page']->value['level'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['page']->value['active']||fn_check_is_active_menu_item($_smarty_tpl->tpl_vars['page']->value,$_smarty_tpl->tpl_vars['block']->value['type'])) {?> ty-text-links__active<?php }?>"><?php if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_LINK')) {
$_smarty_tpl->tpl_vars["href"] = new Smarty_variable(fn_url($_smarty_tpl->tpl_vars['page']->value['link']), null, 0);
} else {
$_smarty_tpl->tpl_vars["href"] = new Smarty_variable(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])), null, 0);
}
$_smarty_tpl->_capture_stack[0][] = array("attributes", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['page']->value['new_window']) {?>class="ty-text-links__a"target="_blank"<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8');?>
" <?php echo Smarty::$_smarty_vars['capture']['attributes'];?>
><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page'], ENT_QUOTES, 'UTF-8');?>
</a></li><?php } ?></ul>
<?php }?>
<?php }?><?php }} ?>
