<?php

/**
 * Adds Last.fm Profile Widget actions
 */
add_action('admin_menu', 'lastfm_profile_admin_actions');
add_action('admin_init', 'lastfm_profile_settings_init');

/**
 * Adds a Last.fm Profile Widget item to a wp admin menu
 */
function lastfm_profile_admin_actions() {
	add_options_page("Last.fm Profile", "Last.fm Profile", 'edit_plugins', "Last.fm-Profile", "lastfm_profile_admin");  
}

/**
 * Register Last.fm Profile Widget settings
 */
function lastfm_profile_settings_init() {
	register_setting('lastfm_profile_settings', 'lastfm_profile_username');

	add_settings_section('lastfm_profile_main', 'Last.fm Profile Main Settings', 'lastfm_profile_main_settings', 'Last.fm-Profile');

	add_settings_field('lastfm_profile_username', 'Last.fm Username', 'lastfm_profile_username_field', 'Last.fm-Profile', 'lastfm_profile_main');
	add_settings_field('lastfm_profile_artist_display_count', 'Artist Display Count', 'lastfm_profile_artist_display_count_field', 'Last.fm-Profile', 'lastfm_profile_main');
}

/**
 * Display Last.fm Profile Widget settings
 */
function lastfm_profile_admin() {
?>

<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Last.fm Profile Settings</h2>
	<form action="options.php" method="post" name="options">
		<?php
			settings_fields('lastfm_profile_settings');
			do_settings_sections('Last.fm-Profile');
			submit_button();
		?>
	</form>
</div

<?php 
}

/**
 * Callback functions
 */
function lastfm_profile_main_settings() {}

function lastfm_profile_username_field() {
echo "<input id='lastfm_profile_username' name='lastfm_profile_username' type='text' value='".get_option('lastfm_profile_username')."' />";
}

function lastfm_profile_artist_display_count_field() {
echo "<input id='lastfm_profile_artist_display_count' name='lastfm_profile_artist_display_count' type='text' value='".((get_option('lastfm_profile_artist_display_count') == '') ? 6 : get_option('lastfm_profile_artist_display_count'))."' />";
}

?>