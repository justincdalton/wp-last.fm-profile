
<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Last.fm Profile Widget Settings</h2>
	<form action="options.php" method="post" name="options">
		<?php 
			settings_fields('lastfm_profile_options');
			do_settings_fields('lastfm_profile_options');
			submit_button();
		?>
	</form>
</div
