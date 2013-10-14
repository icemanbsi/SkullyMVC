<?php /* Smarty version Smarty-3.1.13, created on 2013-08-26 12:25:03
         compiled from "/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/items/news.feed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:854125928521ae6af50ccb1-37385293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50acd2a348640238735a8ae888b13120377375e8' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/items/news.feed.tpl',
      1 => 1375942030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '854125928521ae6af50ccb1-37385293',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newsFeed' => 0,
    'feed' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521ae6af57f008_90376592',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521ae6af57f008_90376592')) {function content_521ae6af57f008_90376592($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.url.php';
if (!is_callable('smarty_modifier_parseText')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/modifier.parseText.php';
if (!is_callable('smarty_modifier_truncate')) include '/Volumes/Data/work/apache/kiookioosponsors/library/smarty-3.1.13/libs/plugins/modifier.truncate.php';
?><div class="feedsWrapper">
	<?php  $_smarty_tpl->tpl_vars['feed'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feed']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['newsFeed']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['feed']->key => $_smarty_tpl->tpl_vars['feed']->value){
$_smarty_tpl->tpl_vars['feed']->_loop = true;
?>
		<div class="feed"><a href="<?php echo smarty_function_url(array('path'=>"campaigns/view",'id'=>$_smarty_tpl->tpl_vars['feed']->value['id']),$_smarty_tpl);?>
" target="_blank"><?php echo smarty_modifier_truncate(smarty_modifier_parseText(((($_smarty_tpl->tpl_vars['feed']->value['title']).(" - ")).($_smarty_tpl->tpl_vars['feed']->value['description']))),80);?>
</a></div>
	<?php } ?>
</div><?php }} ?>