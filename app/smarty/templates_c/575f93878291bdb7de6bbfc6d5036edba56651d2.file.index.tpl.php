<?php /* Smarty version Smarty-3.1.13, created on 2013-10-28 14:48:21
         compiled from "/Library/WebServer/Documents/randl/themes/default/app/views/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2125219457526dd0dd496a30-72000302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '575f93878291bdb7de6bbfc6d5036edba56651d2' => 
    array (
      0 => '/Library/WebServer/Documents/randl/themes/default/app/views/home/index.tpl',
      1 => 1382937880,
      2 => 'file',
    ),
    '85354057dbe187615dc357dace0e2ac89cd3b70b' => 
    array (
      0 => '/Library/WebServer/Documents/randl/themes/default/app/views/wrappers/main.tpl',
      1 => 1382946497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2125219457526dd0dd496a30-72000302',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_526dd0dd525195_59738581',
  'variables' => 
  array (
    'baseUrl' => 0,
    'themeUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_526dd0dd525195_59738581')) {function content_526dd0dd525195_59738581($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/Library/WebServer/Documents/randl/app/smarty/plugins/function.lang.php';
if (!is_callable('smarty_function_url')) include '/Library/WebServer/Documents/randl/app/smarty/plugins/function.url.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<title></title>


	<meta name="description" content="<?php echo smarty_function_lang(array('value'=>"mainMetaDesc"),$_smarty_tpl);?>
" />
	<meta name="keywords" content="<?php echo smarty_function_lang(array('value'=>"mainMetaKeywords"),$_smarty_tpl);?>
" />


<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['themeUrl']->value;?>
resources/css/home.css">

</head>
<body>
<!--[if lt IE 10]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->



<div class="main-container global-wrapper " >
	<header class="main-header">
		<div class="search-block">
			<div class="search-container clearfix">
				<div class="f-left">
					<a class="newsletter"><span>訂閱電子報</span></a>
					<span class="separator">|</span>
					<a class="login"><span>成員登入</span></a>
					<span class="separator">|</span>
					<a href="join-alliance.html" class="join-alliance"><span>加入聯盟</span></a>
				</div>

				<form action="" method="get" class="f-left search">
					<input type="text" name="q"><input type="submit" value="">
				</form>
			</div>
		</div>

		<div class="nav-block">
			<h1 class="page-logo"><a href="<?php echo smarty_function_url(array('path'=>"home/index"),$_smarty_tpl);?>
"></a><embed width="320" height="100" src="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
images/logo.swf" quality="high" pluginspage="http://www.adobe.com/go/getflashplayer" align="middle" play="true" loop="true" scale="showall" wmode="window" devicefont="false" bgcolor="#fff" name="logo" menu="true" allowfullscreen="false" allowscriptaccess="sameDomain" salign="" type="application/x-shockwave-flash"></h1>

			<nav class="main-nav">
				<ul class="reset-ul clearfix">
					<li class="parent">
						<a href="introduction.html" class="introduction">聯盟簡介</a>
						<ul class="reset-ul">
							<li class="sub"><a href="<?php echo smarty_function_url(array('path'=>"pages/view",'page'=>"introduction"),$_smarty_tpl);?>
"></a></li>
							<li class="sub"><a href="<?php echo smarty_function_url(array('path'=>"pages/view",'page'=>"services"),$_smarty_tpl);?>
"></a></li>
						</ul>
					</li>
					<li class="parent">
						<a href="members.html" class="members">聯盟成員</a>
						<ul class="reset-ul">
							<li class="sub"><a href="members.html">節能設計</a></li>
							<li class="sub"><a href="members.html">系統設備</a></li>
							<li class="sub"><a href="members.html">綠色能源</a></li>
							<li class="sub"><a href="members.html">能源管理</a></li>
							<li class="sub"><a href="members-branch.html">服務據點</a></li>
						</ul>
					</li>
					<li class="parent"><a href="products.html" class="products">綠色產品</a></li>
					<li class="parent"><a href="news.html" class="news">產業動態</a></li>
					<li class="parent"><a href="green-site.html" class="green-site">綠色網站</a></li>
				</ul>
			</nav>
		</div>

		<div class="header-bg"></div>
	</header>


	<div class="container-block clearfix">
		
<div class="content-block">
	<section class="newsletter">
		<header><h1 class="page-title"></h1></header>

		<div class="content">
			<ul class="reset-ul">
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">2013台灣國際綠色產業展</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">第4屆馬來西亞國際綠色科技及環保產品展(IGEM2013)</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">2013台南生技綠能博覽會</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">環保及綠建築產業拓銷團</span></a></li>
				<li><a href="news-detail.html"><span class="date">2013/09/08</span><span class="title">「海外參展須知及中小企業投資融資輔導介紹」研討會</span></a></li>
			</ul>
		</div>
	</section>

	<section class="member">
		<header><h1 class="page-title"></h1></header>

		<div class="content clearfix">
			<a href="members.html">節能設計</a>
			<a href="members.html">系統設備</a>
			<a href="members.html">綠色能源</a>
			<a href="members.html">能源管理</a>
		</div>
	</section>
</div>

<div class="sidebar">
	<a href="join-alliance.html"></a>
	<a href="news.html"></a>
	<a href="products.html"></a>
</div>

	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<!-- Templates -->
<script type="text/template" id="newsletter">
	<div class="modal-newsletter">
		<form action="" method="">
			<div class="control-group"><input type="text" name="email" value=""></div>

			<footer><input type="button" class="btn close" value=""><input type="submit" class="btn submit" value=""></footer>
		</form>
	</div>
</script>
<script type="text/template" id="login">
	<div class="modal-login">
		<form action="" method="">
			<div class="control-group"><input type="text" name="username" value=""></div>
			<div class="control-group">
				<input type="password" name="password" value="">
				<a class="lost-password"></a>
			</div>

			<footer><input type="button" class="btn close" value=""><input type="submit" class="btn submit" value=""></footer>
		</form>
	</div>
</script>
<script type="text/template" id="lost-password">
	<div class="modal-lost-password">
		<header></header>

		<form action="" method="">
			<div class="control-group email"><input type="text" name="email" value=""></div>
			<div class="control-group text"></div>

			<footer><input type="submit" class="btn submit" value=""></footer>
		</form>
	</div>
</script>
<!-- end of Templates -->

<script data-main="<?php echo $_smarty_tpl->tpl_vars['themeUrl']->value;?>
resources/js/main.js" src="<?php echo $_smarty_tpl->tpl_vars['themeUrl']->value;?>
resources/js/vendor/require.js"></script>


<?php echo $_smarty_tpl->getSubTemplate ("wrappers/items/analytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>