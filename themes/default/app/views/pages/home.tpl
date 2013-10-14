{extends file="wrappers/main.tpl"}
{block name="content"}
<div id="top" class="jumbotron">
	<div class="container">
		{lang value="topContent"}
	</div>
</div>
<div class="container">{lang value="mainContent"}</div>
<div class="container">
	{include file="wrappers/footer.tpl"}
</div>
{/block}