<?php /* Smarty version Smarty-3.1.13, created on 2013-10-14 00:02:52
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/pages/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20778185155258f1f89e7247-07122787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ea2168d06d6eacddbd68c6932d7d1d10ef3ef18' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/pages/home.tpl',
      1 => 1381682600,
      2 => 'file',
    ),
    '489fdde728594b2ea43bb12be71c97b719d4d5b5' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/main.tpl',
      1 => 1381586092,
      2 => 'file',
    ),
    '3c373a537f4144913317a9e9420b841048edf315' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl',
      1 => 1381683655,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20778185155258f1f89e7247-07122787',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5258f1f9713a49_96337257',
  'variables' => 
  array (
    'xmlLang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5258f1f9713a49_96337257')) {function content_5258f1f9713a49_96337257($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Volumes/Data/work/apache/skullyMVC/app/smarty/plugins/function.lang.php';
if (!is_callable('smarty_function_url')) include '/Volumes/Data/work/apache/skullyMVC/app/smarty/plugins/function.url.php';
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
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '20778185155258f1f89e7247-07122787');
content_525ad23cc3cb24_00980884($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wrappers/footer.tpl" */?>
</div>


	
	
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2013-10-14 00:02:52
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_525ad23cc3cb24_00980884')) {function content_525ad23cc3cb24_00980884($_smarty_tpl) {?><footer>
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