{extends file="admin/wrappers/main.tpl"}
{block name=header}<title>Site Admin</title>{/block}
{block name=content}
	<div class="span8">
		{include file='admin/widgets/alerts.tpl' }
		<div class="widget">
			<div class="head dark">
				<div class="icon"><i class="icos-stats-up"></i></div>
				<h2>Campaign Statistics</h2>
			</div>
			<div class="block-fluid">
				{html_table
					loop=''
					table_attr='class="aTable table-hover rows_5" rel="'|cat:url('admin/campaigns/stats')|cat:'"style="width: 100%;"'
					th_attr=$campaignStatsTh
					cols=$campaignStatsCols
				}
			</div>
		</div>
	</div>

	<div class="span4">
		{include file="admin/widgets/rightbar.tpl"}
	</div>
{/block}
{block name=mid}
<div class="widget">
	<div class="head dark">
		<div class="icon"><i class="icos-calendar"></i></div>
		<h2>Upcoming Campaigns and Events</h2>
	</div>
	<div class="block-fluid">
		<div id="main_calendar"></div>
	</div>
</div>
<div id="fcAddEvent" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="fcAddEventLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="fcAddEventLabel">Add new event</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span3">Title:</div>
			<div class="span9"><input type="text" id="fcAddEventTitle"/></div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="fcAddEventButton">Add</button>
	</div>
</div>
{/block}
{block name=footer}
<script type="text/javascript">

</script>
{/block}