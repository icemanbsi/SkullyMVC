<?php /* Smarty version Smarty-3.1.13, created on 2013-08-27 19:00:26
         compiled from "/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:625478449521b275160c207-86033269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e8d432ae5c1731dcad6a90cff2bdc04c4626296' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/home/index.tpl',
      1 => 1377512264,
      2 => 'file',
    ),
    'e68a815e49709681cae9d4512372c41d1442fbbc' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/main.tpl',
      1 => 1377513106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '625478449521b275160c207-86033269',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521b2751970157_44013006',
  'variables' => 
  array (
    'xmlLang' => 0,
    'themeUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521b2751970157_44013006')) {function content_521b2751970157_44013006($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.url.php';
if (!is_callable('smarty_function_lang')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.lang.php';
?><!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xml:lang="<?php echo $_smarty_tpl->tpl_vars['xmlLang']->value;?>
" lang="<?php echo $_smarty_tpl->tpl_vars['xmlLang']->value;?>
">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	
		<title>KiooKioo.com</title>
	
</head>
<body>
	<div class="clearfix head">
		<div class="clearfix toplogo">
			<div class="centerWrapper">
				<a href="<?php echo smarty_function_url(array('path'=>'home/index'),$_smarty_tpl);?>
" class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['themeUrl']->value;?>
resources/images/LogoKiooKioo.png" /></a>
			</div>
		</div>
		<div class="clearfix topbar">
		</div>
	</div>
	<div class="clearfix">
		<div class="mainContent centerWrapper">
		
<div class="mainArea">
	<div class="txtCenter"><img src="<?php echo $_smarty_tpl->tpl_vars['themeUrl']->value;?>
resources/images/kiooBig.png" /></div>
	<h1 class="title"><?php echo smarty_function_lang(array('value'=>"mainTitle"),$_smarty_tpl);?>
</h1>
	<h2 class="subtitle"><?php echo smarty_function_lang(array('value'=>"mainSubtitle"),$_smarty_tpl);?>
</h2>
</div>

		</div>
	</div>
	<div class="footerWrapper centerWrapper">
		<?php echo $_smarty_tpl->getSubTemplate ("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	<div id="mainLoadingModal" class="loadingWrapper fullscreen" style="">
		<div class="loading fullWidth fullHeight"></div>
	</div>
	<div class="mainModal"></div>
	<script>
	</script>

	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/dialogTemplate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	
	
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>