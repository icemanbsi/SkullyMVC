<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xml:lang="{$xmlLang}" lang="{$xmlLang}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
	{include file="wrappers/header.tpl"}
	{block name="meta"}{/block}
	{block name=headerAdditional}
		<title>KiooKioo.com</title>
	{/block}
</head>
<body>
	<div class="clearfix head">
		<div class="clearfix toplogo">
			<div class="centerWrapper">
				<a href="{url path='home/index'}" class="logo"><img src="{$themeUrl}resources/images/LogoKiooKioo.png" /></a>
			</div>
		</div>
		<div class="clearfix topbar">
		</div>
	</div>
	<div class="clearfix">
		<div class="mainContent centerWrapper">
		{block name=content}Content here{/block}
		</div>
	</div>
	<div class="footerWrapper centerWrapper">
		{include file="wrappers/footer.tpl"}
	</div>
	<div id="mainLoadingModal" class="loadingWrapper fullscreen" style="">
		<div class="loading fullWidth fullHeight"></div>
	</div>
	<div class="mainModal"></div>
	<script>
	</script>

	{include file="wrappers/dialogTemplate.tpl"}

	{block name="scripts"}
	{/block}
	{include file="wrappers/items/analytics.tpl"}
</body>
</html>