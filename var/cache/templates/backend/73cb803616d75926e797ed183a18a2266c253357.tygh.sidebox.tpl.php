<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:10:01
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\common\sidebox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1125458a177e960efb9-24436697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73cb803616d75926e797ed183a18a2266c253357' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\common\\sidebox.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1125458a177e960efb9-24436697',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a177e9620090_59793982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a177e9620090_59793982')) {function content_58a177e9620090_59793982($_smarty_tpl) {?><?php if (trim($_smarty_tpl->tpl_vars['content']->value)) {?>
    <div class="sidebar-row">
        <h6><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</h6>
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? "&nbsp;" : $tmp);?>

    </div>
    <hr />
<?php }?><?php }} ?>
