{* Template of all dialogs displayed in front end. Instead of using this directly, copy then display this *}
{* when called with $.kioo.dialog(url, options, callback) *}
{* float to left so it can resize its width to content, which will then be used in ajax loaded content. *}
<div id="dialogTemplate"><div class="content left">
	<div style="margin: 20px auto; width: 275px;" class="txtCenter">
		<span class="loading"></span><br />
		<b>{lang value="waitAMoment"}</b>
	</div>
</div></div>
<div id="alertDialog"></div>
<div id="confirmDialog"></div>