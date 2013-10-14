{extends file="wrapper.tpl"}
{block name="content"}
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>
					Language Files Editor
				</h1>
			</div>
			<ul class="breadcrumb">
				{foreach $otherLanguages as $otherLanguage}
					<div class="pull-right"><a href="{$otherLanguage.url}">Edit {$otherLanguage.name}</a></div>
				{/foreach}
				{foreach $breadcrumbs as $breadcrumb}
					{if $breadcrumb.active}
						<li class="active">{$breadcrumb.label}</li>
						{else}
						<li><a href="{$breadcrumb.url}">{$breadcrumb.label}</a></li>
					{/if}
				{/foreach}
			</ul>
			<form id="form" method="post" action="{$updateUrl}">
				<h2>{$item.key}:</h2>
				<textarea name="value" id="entryValue">{$item.value}</textarea>
				<br />
				<input type="submit" class="btn btn-primary pull-right" name="submit" value="save" />
			</form>
			<h4>How it looks on the site:</h4>
			<hr />
			<div id="howItLooks">
				{$item.value}
			</div>
			<script>
				$('#form').submit(function() {
					$('#howItLooks').html($(editor.getData()));
				});
				var editor = CKEDITOR.replace( 'entryValue', {
					on: {
						change: function(e) {
							$('#howItLooks').html($(e.editor.getData()));
						}
					}
				} );
			</script>
		</div>
	</div>
{/block}