<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="stylesheet" href="{$bootstrapBaseUrl}css/bootstrap.min.css" />
	<link rel="stylesheet" src="{$bootstrapThemeUrl}"/>
	<link rel="stylesheet" src="{$bootstrapBaseUrl}css/bootstrap.icon-large.min.css"/>
	<script type="text/javascript" src="{$ckEditorUrl}"></script>
	<script type="text/javascript" src="{$jqueryUrl}"></script>
	<script src="{$bootstrapBaseUrl}js/bootstrap.min.js"></script>
	<style type="text/css">
		{$styles}
	</style>
	<script>
		{$scripts}
	</script>
</head>
<body>
<div class="container">
	{if !empty($message)}
		{if $message == 'updated'}
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					Update Successful
				</h4>
			</div>
		{/if}
		{if $message == 'failed'}
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					Update failed
				</h4> Something might be wrong with the value you just uploaded.
			</div>
		{/if}
	{/if}
	{block name="content"}{/block}
	<div class="row">
		<div class="span12">
			<hr />
			<div class="footer">
				<p>&copy; Glyphicons provided by <a target="_blank" rel="nofollow" href="http://glyphicons.com">glyphicons.com</a></p>
			</div>
		</div>
	</div>
</div>
</body>
</html>