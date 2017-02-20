<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:46:00
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\common\tooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:635858a18058194de0-25311536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b1d5f92aadac76cc2209429c435026de10352ec' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\common\\tooltip.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '635858a18058194de0-25311536',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tooltip' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a180581aa861_85029853',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a180581aa861_85029853')) {function content_58a180581aa861_85029853($_smarty_tpl) {?>&nbsp;<?php if ($_smarty_tpl->tpl_vars['tooltip']->value) {?><a class="cm-tooltip<?php if ($_smarty_tpl->tpl_vars['params']->value) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value, ENT_QUOTES, 'UTF-8');
}?>" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tooltip']->value, ENT_QUOTES, 'UTF-8');?>
"><i class="icon-question-sign"></i></a><?php }?><?php }} ?>
