<?php /* Smarty version Smarty-3.1.13, created on 2013-10-14 09:17:30
         compiled from "/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:367919089525a7661df5214-55606520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3000aaea43e81447e7439feec6ffce4962c45c4' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/edit.tpl',
      1 => 1381717046,
      2 => 'file',
    ),
    '2cb6bd15a8319fd328e8d32e3d1bf659f837aef4' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/wrapper.tpl',
      1 => 1381687705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '367919089525a7661df5214-55606520',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_525a7662169776_16991782',
  'variables' => 
  array (
    'bootstrapBaseUrl' => 0,
    'bootstrapThemeUrl' => 0,
    'ckEditorUrl' => 0,
    'jqueryUrl' => 0,
    'styles' => 0,
    'scripts' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525a7662169776_16991782')) {function content_525a7662169776_16991782($_smarty_tpl) {?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['bootstrapBaseUrl']->value;?>
css/bootstrap.min.css" />
	<link rel="stylesheet" src="<?php echo $_smarty_tpl->tpl_vars['bootstrapThemeUrl']->value;?>
"/>
	<link rel="stylesheet" src="<?php echo $_smarty_tpl->tpl_vars['bootstrapBaseUrl']->value;?>
css/bootstrap.icon-large.min.css"/>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['ckEditorUrl']->value;?>
"></script>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['jqueryUrl']->value;?>
"></script>
	<script src="<?php echo $_smarty_tpl->tpl_vars['bootstrapBaseUrl']->value;?>
js/bootstrap.min.js"></script>
	<style type="text/css">
		<?php echo $_smarty_tpl->tpl_vars['styles']->value;?>

	</style>
	<script>
		<?php echo $_smarty_tpl->tpl_vars['scripts']->value;?>

	</script>
</head>
<body>
<div class="container">
	<?php if (!empty($_smarty_tpl->tpl_vars['message']->value)){?>
		<?php if ($_smarty_tpl->tpl_vars['message']->value=='updated'){?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					Update Successful
				</h4>
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['message']->value=='failed'){?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					Update failed
				</h4> Something might be wrong with the value you just uploaded.
			</div>
		<?php }?>
	<?php }?>
	
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>
					Language Files Editor
				</h1>
			</div>
			<ul class="breadcrumb">
				<?php  $_smarty_tpl->tpl_vars['otherLanguage'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['otherLanguage']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['otherLanguages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['otherLanguage']->key => $_smarty_tpl->tpl_vars['otherLanguage']->value){
$_smarty_tpl->tpl_vars['otherLanguage']->_loop = true;
?>
					<div class="pull-right"><a href="<?php echo $_smarty_tpl->tpl_vars['otherLanguage']->value['url'];?>
">Edit <?php echo $_smarty_tpl->tpl_vars['otherLanguage']->value['name'];?>
</a></div>
				<?php } ?>
				<?php  $_smarty_tpl->tpl_vars['breadcrumb'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['breadcrumb']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['breadcrumbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb']->key => $_smarty_tpl->tpl_vars['breadcrumb']->value){
$_smarty_tpl->tpl_vars['breadcrumb']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['breadcrumb']->value['active']){?>
						<li class="active"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['label'];?>
</li>
						<?php }else{ ?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['label'];?>
</a></li>
					<?php }?>
				<?php } ?>
			</ul>
			<form id="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['updateUrl']->value;?>
">
				<h2><?php echo $_smarty_tpl->tpl_vars['item']->value['key'];?>
:</h2>
				<textarea name="value" id="entryValue"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</textarea>
				<br />
				<input type="submit" class="btn btn-primary pull-right" name="submit" value="save" />
			</form>
			<h4>How it looks on the site:</h4>
			<hr />
			<div id="howItLooks">
				<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>

			</div>
			<script>
				$('#form').submit(function() {
					$('#howItLooks').html($(editor.getData()));
				});
				var editor = CKEDITOR.replace( 'entryValue', {
					on: {
						change: function(e) {
							$('#howItLooks').html($(e.editor.getData()));
						}
					}
				} );
			</script>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<hr />
			<div class="footer">
				<p>&copy; Glyphicons provided by <a target="_blank" rel="nofollow" href="http://glyphicons.com">glyphicons.com</a></p>
			</div>
		</div>
	</div>
</div>
</body>
</html><?php }} ?>