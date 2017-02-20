<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:45:54
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\views\block_manager\render\container.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1066858a180527ba6f7-50012582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a07e4bc6a9cabb0bdbbcaacaefa6f75ad2513b6' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\views\\block_manager\\render\\container.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1066858a180527ba6f7-50012582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'container' => 0,
    'dynamic_object' => 0,
    'linked' => 0,
    'location' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a18052896938_07308362',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a18052896938_07308362')) {function content_58a18052896938_07308362($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\modifier.in_array.php';
?><?php
fn_preload_lang_vars(array('container_not_used','set_custom_configuration','insert_grid','insert_grid','container_options','enable_or_disable_container','use_default_block_configuration'));
?>
<?php if ($_smarty_tpl->tpl_vars['container']->value['default']!=1&&!$_smarty_tpl->tpl_vars['dynamic_object']->value&&smarty_modifier_in_array($_smarty_tpl->tpl_vars['container']->value['position'],array("TOP_PANEL","HEADER","FOOTER"))&&$_smarty_tpl->tpl_vars['container']->value['linked_to_default']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars['linked'] = new Smarty_variable(true, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['linked'] = new Smarty_variable(false, null, 0);?>
<?php }?>

<div id="container_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['container']->value['container_id'], ENT_QUOTES, 'UTF-8');?>
" class="container container_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['container']->value['width'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['linked']->value) {?>container-lock<?php }?> <?php if ($_smarty_tpl->tpl_vars['container']->value['status']=="D") {?>container-off<?php }?>" <?php if ($_smarty_tpl->tpl_vars['container']->value['status']!="A") {?>data-ca-status="disabled"<?php } else { ?>data-ca-status="active"<?php }?>>
    <?php if ($_smarty_tpl->tpl_vars['linked']->value) {?><p><?php echo $_smarty_tpl->__("container_not_used",array("[container]"=>$_smarty_tpl->__($_smarty_tpl->tpl_vars['container']->value['position'])));?>
 <a class="cm-post" href="<?php echo htmlspecialchars(fn_url("block_manager.set_custom_container?container_id=".((string)$_smarty_tpl->tpl_vars['container']->value['container_id'])."&linked_to_default=N&selected_location=".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("set_custom_configuration");?>
</a></p><?php }?>

    <?php if ($_smarty_tpl->tpl_vars['container']->value['default']==1||$_smarty_tpl->tpl_vars['container']->value['position']=='CONTENT'||$_smarty_tpl->tpl_vars['dynamic_object']->value||$_smarty_tpl->tpl_vars['container']->value['linked_to_default']!="Y") {?>
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    <?php }?>
    
    <div class="clearfix"></div>
    <div class="grid-control-menu bm-control-menu">
        <?php if ($_smarty_tpl->tpl_vars['container']->value['default']==1||$_smarty_tpl->tpl_vars['container']->value['position']=='CONTENT'&&!$_smarty_tpl->tpl_vars['dynamic_object']->value||$_smarty_tpl->tpl_vars['container']->value['linked_to_default']!="Y") {?>
            <div class="grid-control-menu-actions">
                <div class="btn-group action">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-plus cm-tooltip" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("insert_grid");?>
"></span></a>
                    <ul class="dropdown-menu droptop">
                        <li><a href="#" class="cm-action bm-action-add-grid"><?php echo $_smarty_tpl->__("insert_grid");?>
</a></li>
                    </ul>
                </div>
                <div class="cm-tooltip cm-action icon-cog bm-action-properties action" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("container_options");?>
"></div>
                <div class="cm-action bm-action-switch cm-tooltip icon-off action" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("enable_or_disable_container");?>
"></div>
            </div>
        <?php }?>

        <h4 class="grid-control-title"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['container']->value['position']);?>

            <?php if ($_smarty_tpl->tpl_vars['container']->value['default']!=1&&!$_smarty_tpl->tpl_vars['dynamic_object']->value&&smarty_modifier_in_array($_smarty_tpl->tpl_vars['container']->value['position'],array("TOP_PANEL","HEADER","FOOTER"))) {?>
                <a class="cm-post" href="<?php echo htmlspecialchars(fn_url("block_manager.set_custom_container?container_id=".((string)$_smarty_tpl->tpl_vars['container']->value['container_id'])."&linked_to_default=Y&selected_location=".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("use_default_block_configuration");?>
</a>
            <?php }?>
        </h4>
    </div>
<!--container_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['container']->value['container_id'], ENT_QUOTES, 'UTF-8');?>
--></div>

<hr /><?php }} ?>
