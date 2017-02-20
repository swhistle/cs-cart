<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:43:48
         compiled from "D:\OpenServer\domains\cs-cart\design\themes\responsive\templates\blocks\pages\pages_emenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1674258a17fd43aa1e3-94738431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdebac90395b9baac517ac07ecd1fb21c4d36202' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\themes\\responsive\\templates\\blocks\\pages\\pages_emenu.tpl',
      1 => 1486398744,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1674258a17fd43aa1e3-94738431',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'block' => 0,
    'items' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a17fd43fa1d8_72963114',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a17fd43fa1d8_72963114')) {function content_58a17fd43fa1d8_72963114($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?> 

<div class="ty-menu ty-menu-vertical">
    <ul id="vmenu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-menu__items cm-responsive-menu">
        <?php echo $_smarty_tpl->getSubTemplate ("blocks/sidebox_dropdown.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>$_smarty_tpl->tpl_vars['items']->value,'separated'=>true,'submenu'=>false,'name'=>"page",'item_id'=>"page_id",'childs'=>"subpages"), 0);?>

    </ul>
</div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/pages/pages_emenu.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/pages/pages_emenu.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?> 

<div class="ty-menu ty-menu-vertical">
    <ul id="vmenu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-menu__items cm-responsive-menu">
        <?php echo $_smarty_tpl->getSubTemplate ("blocks/sidebox_dropdown.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>$_smarty_tpl->tpl_vars['items']->value,'separated'=>true,'submenu'=>false,'name'=>"page",'item_id'=>"page_id",'childs'=>"subpages"), 0);?>

    </ul>
</div>
<?php }?><?php }} ?>
