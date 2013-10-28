<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$xmlLang}" lang="{$xmlLang}">
<head>
	{include file="wrappers/header.tpl"}
	{block name="meta"}{/block}
	{block name=headerAdditional}
		<title>{lang value="mainTitle"}</title>
		<meta name="description" content="{lang value="mainMetaDesc"}" />
		<meta name="keywords" content="{lang value="mainMetaKeywords"}" />
	{/block}
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
				<a class="navbar-brand" href="#">{lang value="mainTitle"}</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="{url value="pages/"}">Home</a></li>
					<li><a href="#">Features</a></li>
					<li><a href="#">Documentation</a></li>
					<li><a href="#">Need a good webhost?</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	{block name=content}Content here{/block}

	{block name="scripts"}
	{/block}
	{include file="wrappers/items/analytics.tpl"}
</body>
</html>