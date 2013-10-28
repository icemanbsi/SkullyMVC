{extends file="wrappers/main.tpl"}
{block name=headerAdditional}
<title>{$page.title[$xmlLang]}</title>
{/block}

{block name=styleAdditional}
<link rel="stylesheet" href="{$themeUrl}resources/css/introduction.css">
{/block}

{block name=content}
<div class="container-block">
	<header><h1 class="page-title"><small><a href="index.html">首頁</a> &raquo; <a href="introduction.html">聯盟簡介</a> &raquo; 聯盟服務</small></h1></header>

	<div class="content-block">
		{$page.content[$xmlLang]}
	</div>
</div>
{/block}