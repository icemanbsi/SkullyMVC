
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
{include file="wrappers/items/header.tpl"}
{block name=headerAdditional}
	<title>{lang value="mainTitle"}</title>
{/block}
{block name=metaAdditional}
	<meta name="description" content="{lang value="mainMetaDesc"}" />
	<meta name="keywords" content="{lang value="mainMetaKeywords"}" />
{/block}
{block name=styleAdditional}{/block}
</head>
<body>
<!--[if lt IE 10]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->



<div class="main-container global-wrapper {block name=withFooter}{/block}" {block name=dataApp}{/block}>
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
			<h1 class="page-logo"><a href="index.html"></a><embed width="320" height="100" src="{$baseUrl}images/logo.swf" quality="high" pluginspage="http://www.adobe.com/go/getflashplayer" align="middle" play="true" loop="true" scale="showall" wmode="window" devicefont="false" bgcolor="#fff" name="logo" menu="true" allowfullscreen="false" allowscriptaccess="sameDomain" salign="" type="application/x-shockwave-flash"></h1>

			<nav class="main-nav">
				<ul class="reset-ul clearfix">
					<li class="parent">
						<a href="introduction.html" class="introduction">聯盟簡介</a>
						<ul class="reset-ul">
							<li class="sub"><a href="introduction-articles.html"></a></li>
							<li class="sub"><a href="introduction.html"></a></li>
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
		{block name=content}{/block}
	</div>
</div>

{include file="wrappers/items/footer.tpl"}

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

<script data-main="{$themeUrl}resources/js/main.js" src="{$themeUrl}resources/js/vendor/require.js"></script>
{block name="scripts"}
{/block}
{include file="wrappers/items/analytics.tpl"}
</body>
</html>
