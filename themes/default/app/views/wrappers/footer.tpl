<footer>
	<div class="row">
		<hr />
		<div class="col-lg-12">
			<p>SkullyMVC</p>

				<span class="select">
					<select name="_language" id="languageSelector">
						<option {if ($language == 'english')}selected{/if} value="english">English</option>
						<option {if ($language == 'indonesian')}selected{/if} value="indonesian">Indonesia</option>
					</select>
				</span>
			<script type="text/javascript">
				$('#languageSelector').bind('change', function(e) {
					var path = window.location.href;
					var lang = $('#languageSelector').val();
					if (path.indexOf('?') > -1) {
						if (path.indexOf('_language') > -1) {
							path = path.replace(/(_language=).*?(&)/,'$1' + lang + '$2');
						}
						else {
							path = path + '&_language='+lang;
						}
					}
					else {
						path = path+'?_language='+lang;
					}
					window.location.href = path;
				});
			</script>
		</div>
	</div>

</footer>