<?php /* Smarty version Smarty-3.1.13, created on 2013-08-26 15:09:16
         compiled from "/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/pages/products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1886940900521ae606ad25e3-31337114%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cc354037e077756497f455cc9a01efd706bcae7' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/pages/products.tpl',
      1 => 1377494700,
      2 => 'file',
    ),
    'e68a815e49709681cae9d4512372c41d1442fbbc' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/main.tpl',
      1 => 1377504545,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1886940900521ae606ad25e3-31337114',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521ae606cce214_83002386',
  'variables' => 
  array (
    'xmlLang' => 0,
    'themeUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521ae606cce214_83002386')) {function content_521ae606cce214_83002386($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.url.php';
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
resources/images/logo.png" /></a>
			</div>
		</div>
		<div class="clearfix topbar">
		</div>
	</div>
	<div class="clearfix">
		<div class="mainContent centerWrapper">
		test
		</div>
	</div>
	<div class="footerWrapper fullscreen">
		<?php echo $_smarty_tpl->getSubTemplate ("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	<div id="mainLoadingModal" class="loadingWrapper fullscreen" style="">
		<div class="loading fullWidth fullHeight"></div>
	</div>
	<div class="mainModal"></div>
	<script>
		$(document).ready(function(){
			$('.rss').newsfeed();
		});
	</script>

	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/dialogTemplate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	
	
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>