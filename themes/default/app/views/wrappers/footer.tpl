<div class="footer">
	<div class="clear"></div>
	<div class="menu">
		<ul class="horizontalMenu">
			<li><a href="{url path="articles/about"}" {if $pageTab == 1}target="_blank"{/if}>About</a></li>
			<li><a href="{url path="articles/orderForm"}" {if $pageTab == 1}target="_blank"{/if}>Order Form</a></li>
			<li><a href="{url path="articles/terms_conditions"}" {if $pageTab == 1}target="_blank"{/if}>Terms &amp; Conditions</a></li>
			<li><a href="{url path="articles/privacy_policy"}" {if $pageTab == 1}target="_blank"{/if}>Privacy Policy</a></li>
			<li><a href="{url path="articles/faq"}" {if $pageTab == 1}target="_blank"{/if}>FAQ</a></li>
			<li><a href="{url path="articles/contact"}" {if $pageTab == 1}target="_blank"{/if}>Contact Us</a></li>
		</ul>
	</div>
	<div class="copyright txtCenter">
		Not affiliated with Facebook, Inc. &#9679; Powered By KiooKioo
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

<div id="fb-root"></div>