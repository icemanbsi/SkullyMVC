<?php /* Smarty version Smarty-3.1.13, created on 2013-08-26 12:25:03
         compiled from "/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/dialogTemplate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1034305343521ae6af719a24-20702598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c80e219e9608d5c3e5a5c6281856174383c3665' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/dialogTemplate.tpl',
      1 => 1375942030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1034305343521ae6af719a24-20702598',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521ae6af730083_57337105',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521ae6af730083_57337105')) {function content_521ae6af730083_57337105($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.lang.php';
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