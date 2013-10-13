<?php /* Smarty version Smarty-3.1.13, created on 2013-10-14 01:26:40
         compiled from "/Volumes/Data/work/apache/hostingheroes/hostingheroes/library/langEditor/frontend/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13174024525ad6096d1270-99192514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5b035c77ec3205089d76065e246ed2f2f6fca45' => 
    array (
      0 => '/Volumes/Data/work/apache/hostingheroes/hostingheroes/library/langEditor/frontend/templates/index.tpl',
      1 => 1381688659,
      2 => 'file',
    ),
    '4e46c56ae256593d70324baa8173fbcff87c5108' => 
    array (
      0 => '/Volumes/Data/work/apache/hostingheroes/hostingheroes/library/langEditor/frontend/templates/wrapper.tpl',
      1 => 1381687705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13174024525ad6096d1270-99192514',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_525ad609a480e8_30743655',
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
<?php if ($_valid && !is_callable('content_525ad609a480e8_30743655')) {function content_525ad609a480e8_30743655($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/Volumes/Data/work/apache/hostingheroes/hostingheroes/library/smarty-3.1.13/libs/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_addUrlParams')) include '/Volumes/Data/work/apache/hostingheroes/hostingheroes/library/langEditor/smartyPlugins/function.addUrlParams.php';
?><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
			<p>
				Edit the language files used throughout the sites from here.
			</p>
			<p class="text-error">Do not forget to change variable $active to false for online site in /library/langEditor/config.php !</p>

			<ul class="breadcrumb">
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
			<form action="<?php echo $_smarty_tpl->tpl_vars['updateUrl']->value;?>
" method="post" id="form">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<?php if ($_smarty_tpl->tpl_vars['mode']->value=='dir'){?>
							<th>
								Path
							</th>
						<?php }else{ ?>
							<th>
								Value
							</th>
						<?php }?>
						<th>
							Actions
						</th>
					</tr>
					</thead>
					<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

							</td>
							<?php if ($_smarty_tpl->tpl_vars['mode']->value=='dir'){?>
								<td>
									<?php echo $_smarty_tpl->tpl_vars['item']->value['path'];?>

								</td>
							<?php }else{ ?>
								<td>
									<pre class="entry" contenteditable data-name="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"><?php echo smarty_modifier_truncate(htmlentities($_smarty_tpl->tpl_vars['item']->value['value']),80,"...",true);?>
</pre>
								</td>
							<?php }?>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='dir'){?>
									<a class="btn btn-xs btn-link" href="<?php echo smarty_function_addUrlParams(array('url'=>$_smarty_tpl->tpl_vars['indexUrl']->value,'path'=>htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['path'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl);?>
">Browse directory</a>
								<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='file'){?>
									<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
										<a class="btn btn-xs btn-primary" href="<?php echo smarty_function_addUrlParams(array('url'=>$_smarty_tpl->tpl_vars['indexUrl']->value,'path'=>htmlspecialchars($_smarty_tpl->tpl_vars['language']->value['path'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl);?>
">Edit <?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a>
									<?php } ?>
								<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='entry'){?>

									<a class="btn btn-xs btn-primary" href="<?php echo smarty_function_addUrlParams(array('url'=>$_smarty_tpl->tpl_vars['editUrl']->value,'path'=>htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['path'], ENT_QUOTES, 'UTF-8', true),'key'=>$_smarty_tpl->tpl_vars['item']->value['name']),$_smarty_tpl);?>
">Rich Edit</a>
									<a class="btn btn-xs btn-info" href="<?php echo smarty_function_addUrlParams(array('url'=>$_smarty_tpl->tpl_vars['editUrl']->value,'path'=>htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['path'], ENT_QUOTES, 'UTF-8', true),'key'=>$_smarty_tpl->tpl_vars['item']->value['name'],'preview'=>true),$_smarty_tpl);?>
" target="_blank">Preview</a>
								<?php }?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php if ($_smarty_tpl->tpl_vars['mode']->value=='file'){?>
					<div class="text-center">
						<input type="hidden" name="data" id="form-data" />
						<input class="btn btn-success" type="submit" name="submit" value="Save" />
					</div>
				<?php }?>
			</form>
		</div>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['mode']->value=='file'){?>
		<script type="text/javascript">
			$('#form').submit(function(e) {
				var data = {};
				$('.entry').each(function(index, el) {
					data[$(el).attr('data-name')] = $(el).html();
				});
				var dataJSON = JSON.stringify(data);
				$('#form-data').val(dataJSON);
			});
		</script>
	<?php }?>

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