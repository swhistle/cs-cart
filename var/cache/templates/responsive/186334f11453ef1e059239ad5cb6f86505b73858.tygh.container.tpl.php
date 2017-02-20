<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:27:29
         compiled from "D:\OpenServer\domains\cs-cart\design\themes\responsive\templates\views\block_manager\render\container.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3028958a17c010a3e92-62604638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '186334f11453ef1e059239ad5cb6f86505b73858' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\themes\\responsive\\templates\\views\\block_manager\\render\\container.tpl',
      1 => 1486398745,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '3028958a17c010a3e92-62604638',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'layout_data' => 0,
    'container' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a17c010bea83_58788953',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a17c010bea83_58788953')) {function content_58a17c010bea83_58788953($_smarty_tpl) {?><div class="<?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']!="fixed") {?>container-fluid <?php } else { ?>container<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['container']->value['user_class'], ENT_QUOTES, 'UTF-8');?>
">
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

</div><?php }} ?>
