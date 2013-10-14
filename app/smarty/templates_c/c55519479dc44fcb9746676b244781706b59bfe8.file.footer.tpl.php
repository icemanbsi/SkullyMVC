<?php /* Smarty version Smarty-3.1.13, created on 2013-08-26 17:23:45
         compiled from "/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1280040636521ae6af5968b5-42680698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c55519479dc44fcb9746676b244781706b59bfe8' => 
    array (
      0 => '/Volumes/Data/work/apache/kiookioosponsors/themes/default/app/views/wrappers/footer.tpl',
      1 => 1377512619,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1280040636521ae6af5968b5-42680698',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521ae6af677396_48132745',
  'variables' => 
  array (
    'pageTab' => 0,
    'language' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521ae6af677396_48132745')) {function content_521ae6af677396_48132745($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/Volumes/Data/work/apache/kiookioosponsors/app/smarty/plugins/function.url.php';
?><div class="footer">
	<div class="clear"></div>
	<div class="menu">
		<ul class="horizontalMenu">
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/about"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>About</a></li>
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/orderForm"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>Order Form</a></li>
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/terms_conditions"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>Terms &amp; Conditions</a></li>
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/privacy_policy"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>Privacy Policy</a></li>
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/faq"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>FAQ</a></li>
			<li><a href="<?php echo smarty_function_url(array('path'=>"articles/contact"),$_smarty_tpl);?>
" <?php if ($_smarty_tpl->tpl_vars['pageTab']->value==1){?>target="_blank"<?php }?>>Contact Us</a></li>
		</ul>
	</div>
	<div class="copyright txtCenter">
		Not affiliated with Facebook, Inc. &#9679; Powered By KiooKioo
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

<div id="fb-root"></div><?php }} ?>