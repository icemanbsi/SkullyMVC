<?php /* Smarty version Smarty-3.1.13, created on 2013-10-12 13:04:40
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1198098743524adfdbe62e47-75655024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfe2baa5b84a2539138c7302f980728c3c4ae006' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/home/index.tpl',
      1 => 1381557865,
      2 => 'file',
    ),
    '489fdde728594b2ea43bb12be71c97b719d4d5b5' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/main.tpl',
      1 => 1381557799,
      2 => 'file',
    ),
    '3c373a537f4144913317a9e9420b841048edf315' => 
    array (
      0 => '/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl',
      1 => 1381557837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1198098743524adfdbe62e47-75655024',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_524adfdc4d2624_95053923',
  'variables' => 
  array (
    'xmlLang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524adfdc4d2624_95053923')) {function content_524adfdc4d2624_95053923($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Volumes/Data/work/apache/skullyMVC/app/smarty/plugins/function.lang.php';
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
				<a class="navbar-brand" href="#">How to Make A Website</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.html">Home</a></li>
					<li><a href="domain-registration.html">Domain</a></li>
					<li><a href="hosting.html">Hosting</a></li>
					<li><a href="website-building">Website Building</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	
<div id="top" class="jumbotron">
	<div class="container">
		<h1>How to make a website</h1>
		<p>Now you can build awesome websites easily with these quick steps. Completing this crash course should give you a better idea on:</p>
		<ul>
			<li>What tasks are involved in launching your website?</li>
			<li>How much budget do you need to setup a website?</li>
		</ul>
		<p><a class="btn btn-primary btn-lg" href="domain-registration.html">Step 1: Find A Domain &#187;</a></p>
	</div>
</div>

<div class="container">
	<div class="well text-center">
		<p>You may have this million dollar idea and want to share it worldwide; you may have a business and want to promote it; you may be a marketer and your boss told you to find a way to expand the company market; or you simply want to impress your peers.</p>
		<p class="lead">Website is a great way to answer any of these needs.</p>
		<p>Don't have the required technical skills to make one? Do not worry, we will teach you how. As long as you can click a mouse and write a few sentences you should be up and ready to build websites soon!</p>
	</div>
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-lg-4">
			<h2>Step 1: Domain Registration</h2>
			<ul>
				<li>A domain name is what you are going to call your website.</li>
				<li>Find a name better represents your idea.</li>
				<li>A good domain name is something people can easily remember.</li>
				<li>Read our recommendation where to get one.</li>
				<li><b>Cost:</b> <b>$12</b> to <b>$22</b> annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="domain-registration.html">View details &#187;</a></p>
		</div>
		<div class="col-lg-4">
			<h2>Step 2: Get A Hosting</h2>
			<ul>
				<li>Hosting is where your website's physical files stored ("hosted"), and from there linked to the internet.</li>
				<li>Hosting company qualities are decided mainly by their customer support.</li>
				<li>Read our recommendation where to get one.</li>
				<li><b>Cost:</b><b>$100</b> to <b>$200</b> annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="hosting.html">View details &#187;</a></p>
		</div>
		<div class="col-lg-4">
			<h2>Step 3: Website Building</h2>
			<ul>
				<li>You may create your website with various free / paid website builders.</li>
				<li>Or hire a professional web designer for a better peace of mind.</li>
				<li>Which is better? Read our pros and cons on both cases.</li>
				<li>Cost: <b>Free</b> to <b>$500</b> one-off / annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="website-building.html">View details &#187;</a></p>
		</div>
	</div>

	<div class="text-center">
		<h6 style="font-size: 24px;">Are you ready? Let's get started now!</h6>
		<a class="btn btn-primary btn-lg" href="domain-registration.html">Step 1: Domain Registration &#187;</a>
	</div>
	<?php /*  Call merged included template "wrappers/footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1198098743524adfdbe62e47-75655024');
content_5258e678929168_50505742($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wrappers/footer.tpl" */?>
</div>


	<div class="clearfix head">
		<div class="clearfix toplogo">
			<div class="centerWrapper">
				<a href="<?php echo smarty_function_url(array('path'=>'home/index'),$_smarty_tpl);?>
" class="logo">Logo</a>
			</div>
		</div>
		<div class="clearfix topbar">
		</div>
	</div>
	<div class="clearfix">
		<div class="mainContent centerWrapper">
		
<div id="top" class="jumbotron">
	<div class="container">
		<h1>How to make a website</h1>
		<p>Now you can build awesome websites easily with these quick steps. Completing this crash course should give you a better idea on:</p>
		<ul>
			<li>What tasks are involved in launching your website?</li>
			<li>How much budget do you need to setup a website?</li>
		</ul>
		<p><a class="btn btn-primary btn-lg" href="domain-registration.html">Step 1: Find A Domain &#187;</a></p>
	</div>
</div>

<div class="container">
	<div class="well text-center">
		<p>You may have this million dollar idea and want to share it worldwide; you may have a business and want to promote it; you may be a marketer and your boss told you to find a way to expand the company market; or you simply want to impress your peers.</p>
		<p class="lead">Website is a great way to answer any of these needs.</p>
		<p>Don't have the required technical skills to make one? Do not worry, we will teach you how. As long as you can click a mouse and write a few sentences you should be up and ready to build websites soon!</p>
	</div>
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-lg-4">
			<h2>Step 1: Domain Registration</h2>
			<ul>
				<li>A domain name is what you are going to call your website.</li>
				<li>Find a name better represents your idea.</li>
				<li>A good domain name is something people can easily remember.</li>
				<li>Read our recommendation where to get one.</li>
				<li><b>Cost:</b> <b>$12</b> to <b>$22</b> annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="domain-registration.html">View details &#187;</a></p>
		</div>
		<div class="col-lg-4">
			<h2>Step 2: Get A Hosting</h2>
			<ul>
				<li>Hosting is where your website's physical files stored ("hosted"), and from there linked to the internet.</li>
				<li>Hosting company qualities are decided mainly by their customer support.</li>
				<li>Read our recommendation where to get one.</li>
				<li><b>Cost:</b><b>$100</b> to <b>$200</b> annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="hosting.html">View details &#187;</a></p>
		</div>
		<div class="col-lg-4">
			<h2>Step 3: Website Building</h2>
			<ul>
				<li>You may create your website with various free / paid website builders.</li>
				<li>Or hire a professional web designer for a better peace of mind.</li>
				<li>Which is better? Read our pros and cons on both cases.</li>
				<li>Cost: <b>Free</b> to <b>$500</b> one-off / annually</li>
			</ul>
			<p class="text-center"><a class="btn btn-default" href="website-building.html">View details &#187;</a></p>
		</div>
	</div>

	<div class="text-center">
		<h6 style="font-size: 24px;">Are you ready? Let's get started now!</h6>
		<a class="btn btn-primary btn-lg" href="domain-registration.html">Step 1: Domain Registration &#187;</a>
	</div>
	<?php /*  Call merged included template "wrappers/footer.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("wrappers/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1198098743524adfdbe62e47-75655024');
content_5258e678929168_50505742($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wrappers/footer.tpl" */?>
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

	
	
	<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2013-10-12 13:04:40
         compiled from "/Volumes/Data/work/apache/skullyMVC/themes/default/app/views/wrappers/footer.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5258e678929168_50505742')) {function content_5258e678929168_50505742($_smarty_tpl) {?><footer>
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