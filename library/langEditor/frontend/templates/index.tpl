{extends file="wrapper.tpl"}
{block name="content"}
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>
					Language Files Editor
				</h1>
			</div>
			<p>
				Edit the language files used throughout the sites from here.
			</p>
			<p class="text-error">Do not forget to change variable $active to false for online site in /library/langEditor/config.php !</p>

			<ul class="breadcrumb">
				{if $mode == 'file'}
					{foreach $otherLanguages as $otherLanguage}
						<div class="pull-right"><a href="{$otherLanguage.url}">Edit {$otherLanguage.name}</a></div>
					{/foreach}
				{/if}
				{foreach $breadcrumbs as $breadcrumb}
					{if $breadcrumb.active}
						<li class="active">{$breadcrumb.label}</li>
					{else}
						<li><a href="{$breadcrumb.url}">{$breadcrumb.label}</a></li>
					{/if}
				{/foreach}
			</ul>
			<form action="{$updateUrl}" method="post" id="form">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>
							Name
						</th>
						{if $mode == 'dir'}
							<th>
								Path
							</th>
						{else}
							<th>
								Value
							</th>
						{/if}
						<th>
							Actions
						</th>
					</tr>
					</thead>
					<tbody>
					{foreach $items as $item}
						<tr>
							<td>
								{$item.name}
							</td>
							{if $mode == 'dir'}
								<td>
									{$item.path}
								</td>
							{else}
								<td>
									<pre class="entry" contenteditable data-name="{$item.name}">{$item.value|htmlentities}</pre>
								</td>
							{/if}
							<td>
								{if $item.type=='dir'}
									<a class="btn btn-xs btn-link" href="{addUrlParams url=$indexUrl path=$item.path|escape}">Browse directory</a>
								{elseif $item.type=='file'}
									{foreach $item.languages as $language}
										<a class="btn btn-xs btn-primary" href="{addUrlParams url=$indexUrl path=$language.path|escape}">Edit {$language.name}</a>
									{/foreach}
								{elseif $item.type=='entry'}

									<a class="btn btn-xs btn-primary" href="{addUrlParams url=$editUrl path=$item.path|escape key=$item.name}">Rich Edit</a>
									<a class="btn btn-xs btn-info" href="{addUrlParams url=$editUrl path=$item.path|escape key=$item.name preview=true}" target="_blank">Preview</a>
								{/if}
							</td>
						</tr>
					{/foreach}
					</tbody>
				</table>
				{if $mode == 'file'}
					<div class="text-center">
						<input type="hidden" name="data" id="form-data" />
						<input class="btn btn-success" type="submit" name="submit" value="Save" />
					</div>
				{/if}
			</form>
		</div>
	</div>
	{if $mode == 'file'}
		<script type="text/javascript">
			$('#form').submit(function(e) {
				var data = {};
				$('.entry').each(function(index, el) {
					data[$(el).attr('data-name')] = $(el).html();
				});
				var dataJSON = JSON.stringify(data);
				$('#form-data').val(dataJSON);
			});
		</script>
	{/if}
{/block}