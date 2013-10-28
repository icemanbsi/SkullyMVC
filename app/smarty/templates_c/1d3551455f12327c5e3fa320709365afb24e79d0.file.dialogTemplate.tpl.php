<?php /* Smarty version Smarty-3.1.13, created on 2013-10-01 21:44:44
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/dialogTemplate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:533751183524adfdc6c7427-59014334%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d3551455f12327c5e3fa320709365afb24e79d0' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/dialogTemplate.tpl',
      1 => 1375942030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '533751183524adfdc6c7427-59014334',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524adfdc6d9d43_41413936',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524adfdc6d9d43_41413936')) {function content_524adfdc6d9d43_41413936($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Volumes/Data/work/apache/skullyMVC/app/smarty/plugins/function.lang.php';
?>


<div id="dialogTemplate"><div class="content left">
	<div style="margin: 20px auto; width: 275px;" class="txtCenter">
		<span class="loading"></span><br />
		<b><?php echo smarty_function_lang(array('value'=>"waitAMoment"),$_smarty_tpl);?>
</b>
	</div>
</div></div>
<div id="alertDialog"></div>
<div id="confirmDialog"></div><?php }} ?>