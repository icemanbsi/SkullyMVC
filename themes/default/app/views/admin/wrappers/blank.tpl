<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="{$xmlLang}" lang="{$xmlLang}">
<head>
{include file="admin/wrappers/header.tpl"}
{block name=headerAdditional}
	<title>KiooKioo.com</title>
{/block}
</head>
<body>

<div class="clearfix">
	<div class="mainContent centerWrapper">
	{block name=content}Content here{/block}
	</div>
</div>

<div class="loadingWrapper" style="">
	<div class="loading"></div>
</div>
<div class="mainModal"></div>
</body>
</html>