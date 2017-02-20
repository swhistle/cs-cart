<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:43:50
         compiled from "D:\OpenServer\domains\cs-cart\design\themes\responsive\templates\addons\discussion\hooks\pages\page_extra.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:428358a17fd6c5ed78-14252140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d89b4a13908a26d5d20d8a10a0667d554075613' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\themes\\responsive\\templates\\addons\\discussion\\hooks\\pages\\page_extra.post.tpl',
      1 => 1486475232,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '428358a17fd6c5ed78-14252140',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'page' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a17fd6cc9152_08868204',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a17fd6cc9152_08868204')) {function content_58a17fd6cc9152_08868204($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\function.set_id.php';
?><?php
fn_preload_lang_vars(array('discussion_title_page','discussion_title_page'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/view.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('object_id'=>$_smarty_tpl->tpl_vars['page']->value['page_id'],'object_type'=>"A",'title'=>$_smarty_tpl->__("discussion_title_page"),'wrap'=>true,'post_redirect_url'=>fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])."#content_discussion")), 0);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/discussion/hooks/pages/page_extra.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/discussion/hooks/pages/page_extra.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/view.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('object_id'=>$_smarty_tpl->tpl_vars['page']->value['page_id'],'object_type'=>"A",'title'=>$_smarty_tpl->__("discussion_title_page"),'wrap'=>true,'post_redirect_url'=>fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])."#content_discussion")), 0);
}?><?php }} ?>
