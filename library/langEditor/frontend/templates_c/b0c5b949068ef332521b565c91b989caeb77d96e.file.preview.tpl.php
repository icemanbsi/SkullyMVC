<?php /* Smarty version Smarty-3.1.13, created on 2013-10-13 23:16:34
         compiled from "/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1021986215525aa5a4d42bb7-73294222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0c5b949068ef332521b565c91b989caeb77d96e' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/preview.tpl',
      1 => 1381672514,
      2 => 'file',
    ),
    '2cb6bd15a8319fd328e8d32e3d1bf659f837aef4' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/library/langEditor/frontend/templates/wrapper.tpl',
      1 => 1381679378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1021986215525aa5a4d42bb7-73294222',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_525aa5a4e0db71_54750192',
  'variables' => 
  array (
    'bootstrapBaseUrl' => 0,
    'bootstrapThemeUrl' => 0,
    'ckEditorUrl' => 0,
    'jqueryUrl' => 0,
    'styles' => 0,
    'scripts' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525aa5a4e0db71_54750192')) {function content_525aa5a4e0db71_54750192($_smarty_tpl) {?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
	
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<p>
					Previewing value of <b><?php echo $_smarty_tpl->tpl_vars['item']->value['key'];?>
</b> of file <b><?php echo $_smarty_tpl->tpl_vars['item']->value['path'];?>
</b>
				</p>
			</div>
			<div><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</div>
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