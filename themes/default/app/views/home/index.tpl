{extends file="wrappers/main.tpl"}
{block name="content"}
<div class="mainArea">
	<div class="txtCenter"><img src="{$themeUrl}resources/images/kiooBig.png" /></div>
	<h1 class="title">{lang value="mainTitle"}</h1>
	<h2 class="subtitle">{lang value="mainSubtitle"}</h2>
</div>
<div class="newsletterArea">
	<div class="grey">
		<form>
			<input name="name" placeholder="Name" />
			<input name="email" placeholder="Email" />
			<input type="submit" value="{lang value="btnCreateAccount"}" />
		</form>
	</div>
</div>
{/block}