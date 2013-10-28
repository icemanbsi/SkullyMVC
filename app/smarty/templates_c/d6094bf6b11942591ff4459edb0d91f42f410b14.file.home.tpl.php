<?php /* Smarty version Smarty-3.1.13, created on 2013-10-28 09:08:53
         compiled from "/Library/WebServer/Documents/randl/themes/default/app/views/pages/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2135114392526dc7355e9467-07330924%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6094bf6b11942591ff4459edb0d91f42f410b14' => 
    array (
      0 => '/Library/WebServer/Documents/randl/themes/default/app/views/pages/home.tpl',
      1 => 1381718304,
      2 => 'file',
    ),
    '85354057dbe187615dc357dace0e2ac89cd3b70b' => 
    array (
      0 => '/Library/WebServer/Documents/randl/themes/default/app/views/wrappers/main.tpl',
      1 => 1381718304,
      2 => 'file',
    ),
    'd8432454036bf769f29d48444f7285dd0bad3a53' => 
    array (
      0 => '/Library/WebServer/Documents/randl/themes/default/app/views/wrappers/footer.tpl',
      1 => 1381718304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2135114392526dc7355e9467-07330924',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'xmlLang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_526dc7356aa6a5_89047694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_526dc7356aa6a5_89047694')) {function content_526dc7356aa6a5_89047694($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Library/WebServer/Documents/randl/app/smarty/plugins/function.lang.php';
if (!is_callable('smarty_function_url')) include '/Library/WebServer/Documents/randl/app/smarty/plugins/function.url.php';
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->tpl_vars['xmlLang']->value;?>
" lang="<?php echo $_smarty_tpl->tpl_vars['xmlLang']->value;?>
">
<head>
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	
		<title><?php echo smarty_function_lang(array('value'=>"mainTitle"),$_smarty_tpl);?>
</title>
		<meta name="description" content="<?php echo smarty_function_lang(array('value'=>"mainMetaDesc"),$_smarty_tpl);?>
" />
		<meta name="keywords" content="<?php echo smarty_function_lang(array('value'=>"mainMetaKeywords"),$_smarty_tpl);?>
" />
	
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo smarty_function_lang(array('value'=>"mainTitle"),$_smarty_tpl);?>
</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo smarty_function_url(array('value'=>"pages/"),$_smarty_tpl);?>
">Home</a></li>
					<li><a href="#">Features</a></li>
					<li><a href="#">Documentation</a></li>
					<li><a href="#">Need a good webhost?</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	
<div id="top" class="jumbotron">
	<div class="container">
		<?php echo smarty_function_lang(array('value'=>"topContent"),$_smarty_tpl);?>

	</div>
</div>
<div class="container"><?php echo smarty_function_lang(array('value'=>"mainContent"),$_smarty_tpl);?>
</div>
<div class="container">
	<?php /*  Call merged included template "wrappers/footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '2135114392526dc7355e9467-07330924');
content_526dc735692985_87870190($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wrappers/footer.tpl" */?>
</div>


	
	
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2013-10-28 09:08:53
         compiled from "/Library/WebServer/Documents/randl/themes/default/app/views/wrappers/footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_526dc735692985_87870190')) {function content_526dc735692985_87870190($_smarty_tpl) {?><footer>
	<div class="row">
		<hr />
		<div class="col-lg-12">
			<p>SkullyMVC</p>

				<span class="select">
					<select name="_language" id="languageSelector">
						<option <?php if (($_smarty_tpl->tpl_vars['language']->value=='english')){?>selected<?php }?> value="english">English</option>
						<option <?php if (($_smarty_tpl->tpl_vars['language']->value=='indonesian')){?>selected<?php }?> value="indonesian">Indonesia</option>
					</select>
				</span>
			<script type="text/javascript">
				$('#languageSelector').bind('change', function(e) {
					var path = window.location.href;
					var lang = $('#languageSelector').val();
					if (path.indexOf('?') > -1) {
						if (path.indexOf('_language') > -1) {
							path = path.replace(/(_language=).*?(&)/,'$1' + lang + '$2');
						}
						else {
							path = path + '&_language='+lang;
						}
					}
					else {
						path = path+'?_language='+lang;
					}
					window.location.href = path;
				});
			</script>
		</div>
	</div>

</footer><?php }} ?>