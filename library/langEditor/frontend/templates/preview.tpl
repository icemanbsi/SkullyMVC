{extends file="wrapper.tpl"}
{block name="content"}
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<p>
					Previewing value of <b>{$item.key}</b> of file <b>{$item.path}</b>
				</p>
			</div>
			<div>{$item.value}</div>
		</div>
	</div>
{/block}