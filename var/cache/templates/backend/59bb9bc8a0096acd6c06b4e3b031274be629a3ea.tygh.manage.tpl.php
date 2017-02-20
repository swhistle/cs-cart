<?php /* Smarty version Smarty-3.1.21, created on 2017-02-13 12:09:59
         compiled from "D:\OpenServer\domains\cs-cart\design\backend\templates\views\datakeeper\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:392958a177e7d43946-20922063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59bb9bc8a0096acd6c06b4e3b031274be629a3ea' => 
    array (
      0 => 'D:\\OpenServer\\domains\\cs-cart\\design\\backend\\templates\\views\\datakeeper\\manage.tpl',
      1 => 1485344328,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '392958a177e7d43946-20922063',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'database_size' => 0,
    'result_ids' => 0,
    'backup_files' => 0,
    'name' => 0,
    'file' => 0,
    'images_dir' => 0,
    'all_tables' => 0,
    'tbl' => 0,
    'config' => 0,
    'backup_create_allowed' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_58a177e7ed5270_87395241',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a177e7ed5270_87395241')) {function content_58a177e7ed5270_87395241($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_notes')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\block.notes.php';
if (!is_callable('smarty_block_hook')) include 'D:/OpenServer/domains/cs-cart/app/functions/smarty_plugins\\block.hook.php';
?><?php
fn_preload_lang_vars(array('current_database_size','current_database_size','bytes','current_database_size','filename','date','filesize','type','bytes','download','restore','delete','no_items','upload','upload_file','logs','upload_file','optimize_database','backup_files','extra_folders','select_all','unselect_all','backup_data','select_tables','select_all','unselect_all','multiple_selectbox_notice','backup_options','backup_schema','backup_data','backup_filename','text_backup_filename_hint','create_backup','create_backup','backup_restore'));
?>
<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('notes', array('title'=>$_smarty_tpl->__("current_database_size"))); $_block_repeat=true; echo smarty_block_notes(array('title'=>$_smarty_tpl->__("current_database_size")), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <p><span><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['database_size']->value), ENT_QUOTES, 'UTF-8');?>
</span> <?php echo $_smarty_tpl->__("bytes");?>
</p>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_notes(array('title'=>$_smarty_tpl->__("current_database_size")), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <div id="backup_management">
        <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="backups_form">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"backups:manage")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"backups:manage"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_smarty_tpl->tpl_vars['result_ids'] = new Smarty_variable("backup_management,actions_panel", null, 0);?>
                <input type="hidden" name="result_ids" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['result_ids']->value, ENT_QUOTES, 'UTF-8');?>
"/>
            <?php if ($_smarty_tpl->tpl_vars['backup_files']->value) {?>
                <table class="table table-middle">
                    <thead>
                    <tr>
                        <th width="1%">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/check_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</th>
                        <th><?php echo $_smarty_tpl->__("filename");?>
</th>
                        <th><?php echo $_smarty_tpl->__("date");?>
</th>
                        <th><?php echo $_smarty_tpl->__("filesize");?>
</th>
                        <th><?php echo $_smarty_tpl->__("type");?>
</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['backup_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['file']->key;
?>
                        <tr>
                            <td><input type="checkbox" name="backup_files[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="checkbox cm-item"/>
                            </td>
                            <td><a href="<?php echo htmlspecialchars(fn_url("datakeeper.getfile?file=".((string)$_smarty_tpl->tpl_vars['name']->value)), ENT_QUOTES, 'UTF-8');?>
"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</span></a></td>
                            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value['create'], ENT_QUOTES, 'UTF-8');?>
</td>
                            <td><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['file']->value['size']), ENT_QUOTES, 'UTF-8');?>
&nbsp;<?php echo $_smarty_tpl->__("bytes");?>
</td>
                            <td><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['file']->value['type']);?>
</td>
                            <td class="nowrap">
                                <div class="hidden-tools">
                                    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                                        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("download"),'href'=>"datakeeper.getfile?file=".((string)$_smarty_tpl->tpl_vars['name']->value)));?>
</li>
                                        <?php if ($_smarty_tpl->tpl_vars['file']->value['can_be_restored']) {?>
                                            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'class'=>"cm-confirm",'text'=>$_smarty_tpl->__("restore"),'href'=>"datakeeper.restore?backup_file=".((string)$_smarty_tpl->tpl_vars['name']->value),'method'=>"POST"));?>
</li>
                                        <?php }?>
                                        <li class="divider"></li>
                                        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'class'=>"cm-confirm cm-ajax",'text'=>$_smarty_tpl->__("delete"),'href'=>"datakeeper.delete?backup_file=".((string)$_smarty_tpl->tpl_vars['name']->value),'data'=>array("data-ca-target-id"=>$_smarty_tpl->tpl_vars['result_ids']->value),'method'=>"POST"));?>
</li>
                                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p class="no-items"><?php echo $_smarty_tpl->__("no_items");?>
</p>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"backups:manage"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </form>
        <!--backup_management--></div>
    <?php $_smarty_tpl->_capture_stack[0][] = array("upload_backup", null, null); ob_start(); ?>
        
        <div class="install-addon" id="content_upload_backup">
            <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="upload_backup_form" class="form-horizontal"
                  enctype="multipart/form-data">
                <input type="hidden" name="result_ids" value="theme_upload_container"/>

                <div class="install-addon-wrapper">
                    <img class="install-addon-banner" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_dir']->value, ENT_QUOTES, 'UTF-8');?>
/addon_box.png" width="151px" height="141px"/>
                    <?php echo $_smarty_tpl->getSubTemplate ("common/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"dump[0]",'allowed_ext'=>"zip,tgz,sql"), 0);?>


                </div>

                <div class="buttons-container">
                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("upload"),'but_name'=>"dispatch[datakeeper.upload]",'cancel_action'=>"close",'but_role'=>"submit-link"), 0);?>

                </div>
            </form>
        </div>
        
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"upload_backup",'text'=>$_smarty_tpl->__("upload_file"),'content'=>Smarty::$_smarty_vars['capture']['upload_backup'],'link_class'=>"cm-dialog-auto-size"), 0);?>


    <?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("logs"),'href'=>"logs.manage"));?>
</li>
            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'text'=>$_smarty_tpl->__("upload_file"),'target_id'=>"content_upload_backup",'form'=>"upload_backup_form",'class'=>"cm-dialog-auto-size"));?>
</li>
            <li><a href="<?php echo htmlspecialchars(fn_url("datakeeper.optimize"), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="elm_sidebar"
                   class="cm-post cm-comet cm-ajax"><?php echo $_smarty_tpl->__("optimize_database");?>
</a></li>
            <?php if ($_smarty_tpl->tpl_vars['backup_files']->value) {?>
                <li class="divider"></li>
                <li>
                    <?php smarty_template_function_btn($_smarty_tpl,array('type'=>"delete_selected",'dispatch'=>"dispatch[datakeeper.m_delete]",'form'=>"backups_form",'class'=>"cm-ajax"));?>

                </li>
            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
            
            <div id="content_backup">
                <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="backup_form"
                      class="form-horizontal form-edit cm-ajax cm-comet cm-form-dialog-closer">
                    <input type="hidden" name="selected_section" value="backup"/>
                    <input type="hidden" name="result_ids" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['result_ids']->value, ENT_QUOTES, 'UTF-8');?>
"/>

                    <div class="control-group">
                        <label class="control-label" for="elm_backup_files"><?php echo $_smarty_tpl->__("backup_files");?>
:</label>

                        <div class="controls">
                            <label class="checkbox">
                                <input type="hidden" name="backup_files" value="N"/>
                                <input type="checkbox" name="backup_files" id="elm_backup_files" value="Y"
                                       onclick="Tygh.$('#files_backup_options').toggleBy();"/>
                            </label>
                        </div>
                    </div>

                    <div id="files_backup_options" class="hidden">
                        <hr>
                        <div class="control-group">
                            <label for="extra_folders" class="control-label"><?php echo $_smarty_tpl->__("extra_folders");?>
:</label>

                            <div class="controls">
                                <select name="extra_folders[]" id="extra_folders" multiple="multiple" size="5">
                                    <option value="images">images</option>
                                    <option value="var/files">var/files</option>
                                    <option value="var/attachments">var/attachments</option>
                                    <option value="var/langs">var/langs</option>
                                </select>

                                <p><a onclick="Tygh.$('#extra_folders').selectOptions(true); return false;"
                                      class="underlined"><?php echo $_smarty_tpl->__("select_all");?>
</a> / <a
                                            onclick="Tygh.$('#extra_folders').selectOptions(false); return false;"
                                            class="underlined"><?php echo $_smarty_tpl->__("unselect_all");?>
</a></p>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="elm_backup_database"><?php echo $_smarty_tpl->__("backup_data");?>
:</label>

                        <div class="controls">
                            <label class="checkbox">
                                <input type="hidden" name="backup_database" value="N"/>
                                <input type="checkbox" name="backup_database" id="elm_backup_database" value="Y"
                                       checked="checked" onclick="Tygh.$('#database_backup_options').toggleBy();"/>
                            </label>
                        </div>
                    </div>

                    <div id="database_backup_options">
                        <hr>
                        <div class="control-group">
                            <label for="dbdump_tables" class="control-label"><?php echo $_smarty_tpl->__("select_tables");?>
:</label>

                            <div class="controls">
                                <select name="dbdump_tables[]" id="dbdump_tables" multiple="multiple" size="10">
                                    <?php  $_smarty_tpl->tpl_vars['tbl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tbl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['all_tables']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tbl']->key => $_smarty_tpl->tpl_vars['tbl']->value) {
$_smarty_tpl->tpl_vars['tbl']->_loop = true;
?>
                                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tbl']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['config']->value['table_prefix']==''||strpos($_smarty_tpl->tpl_vars['tbl']->value,$_smarty_tpl->tpl_vars['config']->value['table_prefix'])===0) {?> selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tbl']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php } ?>
                                </select>

                                <p><a onclick="Tygh.$('#dbdump_tables').selectOptions(true); return false;"
                                      class="underlined"><?php echo $_smarty_tpl->__("select_all");?>
</a> / <a
                                            onclick="Tygh.$('#dbdump_tables').selectOptions(false); return false;"
                                            class="underlined"><?php echo $_smarty_tpl->__("unselect_all");?>
</a></p>

                                <div class="muted"><?php echo $_smarty_tpl->__("multiple_selectbox_notice");?>
</div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="dbdump_filename" class="control-label">
                                <?php echo $_smarty_tpl->__("backup_options");?>
:
                            </label>

                            <div class="controls">
                                <label for="dbdump_schema" class="checkbox">
                                    <input type="checkbox" name="dbdump_schema" id="dbdump_schema" value="Y"
                                           checked="checked">
                                    <?php echo $_smarty_tpl->__("backup_schema");?>

                                </label>
                                <label for="dbdump_data" class="checkbox">
                                    <input type="checkbox" name="dbdump_data" id="dbdump_data" value="Y"
                                           checked="checked">
                                    <?php echo $_smarty_tpl->__("backup_data");?>

                                </label>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="control-group">
                        <label for="dbdump_filename" class="control-label"><?php echo $_smarty_tpl->__("backup_filename");?>
:</label>

                        <div class="controls">
                            <div class="input-append">
                                <input type="text" name="dbdump_filename" id="dbdump_filename" size="30"
                                       value="backup_<?php echo htmlspecialchars(@constant('PRODUCT_VERSION'), ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars(date("dMY_His",time()), ENT_QUOTES, 'UTF-8');?>
" class="input-text">
                                <span class="add-on">.zip</span>
                            </div>
                            <p class="muted"><?php echo $_smarty_tpl->__("text_backup_filename_hint");?>
</p>
                        </div>
                    </div>

                    <div class="buttons-container">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[datakeeper.backup]",'cancel_action'=>"close",'but_role'=>"submit-link",'but_meta'=>"cm-comet"), 0);?>

                    </div>
                </form>
            </div>
            
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php if ($_smarty_tpl->tpl_vars['backup_create_allowed']->value) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"create_backup",'text'=>$_smarty_tpl->__("create_backup"),'title'=>$_smarty_tpl->__("create_backup"),'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'act'=>"create",'icon'=>"icon-plus"), 0);?>

        <?php }?>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("backup_restore"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons']), 0);?>
<?php }} ?>
