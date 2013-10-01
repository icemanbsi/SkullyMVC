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
{*{if !$isLogin}*}
{*<div class="login">*}
	{*<a href="javascript:;" onclick="top.location.href='{$loginUrl}';">*}
		{*<img src="{$themeUrl}resources/images/btnLogin.png" />*}
	{*</a>*}
{*</div>*}
{*{/if}*}
{block name="contentTop"}
{/block}

{if $pageTab == 0}
<div class="clearfix head">
	<div class="clearfix topbar big centerWrapper">
		<div class="centerWrapper">
			{if $isLogin}
				<div class="home bold"><a href="{url path='home/index'}"><i class="home"></i>HOME</a></div>
				<div class="account" title="{$user.firstName} {$user.lastName}">
					<a href="{url path="users/profile"}">
						<img class="avatar left" src="{$user.avatar}" />
						<div>{$user.firstName|truncate:18}</div>
						<div>My Profile</div>
					</a>
				</div>
				<div class="attended"><a href="{url path="users/profile" type="attended"}">{lang value="attended"} <span class="bellow bold">{if empty($user.attended)}0{else}{$user.attended}{/if}</span></a></div>
				<div class="ongoing"><a href="{url path="users/profile" type="onGoing"}">{lang value="onGoing"} <span class="bellow bold">{$user.onGoing}</span></a></div>
				<div class="win"><a href="{url path="users/profile" type="won"}">{lang value="won"} <span class="bellow bold">{$user.win}</span></a></div>
				<div class="fb"><a href="{$clientConfig.facebookPage}" target="_blank"><i class="fb"></i><span class="bellow">VISIT OUR PAGES</span></a></div>
				<div class="logo">
					<img src="{$themeUrl}resources/images/logo-small.png" />
				</div>
			{else}
				<div class="home bold"><a href="{url path='home/index'}"><i class="home"></i>HOME</a></div>
				<div class="account"></div>
				<div class="attended"><a href="#">Attended <span class="bellow bold">0</span></a></div>
				<div class="ongoing"><a href="#">On Going <span class="bellow bold">0</span></a></div>
				<div class="win"><a href="#">Win <span class="bellow bold">0</span></a></div>
				<div class="fb"><a href="{$clientConfig.facebookPage}" target="_blank"><i class="fb"></i><span class="bellow">{lang value="visit"}</span></a></div>
				<div class="logo">
					<img src="{$themeUrl}resources/images/logo-small.png" />
				</div>
			{/if}
		</div>
		<div class="bottomLine"></div>
	</div>
</div>
{/if}
<div class="clearfix">
	<div class="mainContent centerWrapper">
	{block name=content}Content here{/block}
	</div>
</div>

<div class="footerWrapper">
{include file="wrappers/footer.tpl"}
</div>
<div id="mainLoadingModal" class="loadingWrapper fullscreen" style="">
	<div class="loading fullWidth fullHeight"></div>
</div>
<div class="mainModal"></div>
{include file="wrappers/dialogTemplate.tpl"}

{block name="scripts"}
{/block}
{include file="wrappers/items/analytics.tpl"}
</body>
</html>