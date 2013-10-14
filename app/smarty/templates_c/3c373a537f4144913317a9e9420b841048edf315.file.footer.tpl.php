<?php /* Smarty version Smarty-3.1.13, created on 2013-10-12 13:04:41
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:998688840524adfdc5fd1c6-04518368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c373a537f4144913317a9e9420b841048edf315' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl',
      1 => 1381557837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '998688840524adfdc5fd1c6-04518368',
  'function' => 
  array (
  ),
  'unifunc' => 'content_524adfdc6bf8f0_07118131',
  'variables' => 
  array (
    'language' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524adfdc6bf8f0_07118131')) {function content_524adfdc6bf8f0_07118131($_smarty_tpl) {?><footer>
	<div class="row">
		<hr />
		<div class="col-lg-12">
			<b>Published your site? Good, here are the next steps:</b>
			<ul class="list-unstyled">
				<li class="pull-right"><a href="#top">Back to top</a></li>
				<li><a href="seo.html">search engine optimization</a></li>
				<li><a href="social-media-promotion.html">social media promotion</a></li>
			</ul>
			<p>&copy; make-a-website.org 2013</p>

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