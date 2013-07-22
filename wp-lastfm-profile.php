<?php
/*
Plugin Name: wp-last.fm-profile
Plugin URI: http://github.com/justincdalton/wp-last.fm-profile
Description: WordPress plugin to display details from your last.fm profile 
Version: 1.0
Author: Justin C Dalton
Author URI: http://justincdalton.com
License: MIT
*/

/**
 * Set the number of artists to display
 */
$artistDisplayCount = 12;

/**
 * Include Last.fm Profile Widget admin settings
 */
//include('wp-lastfm-profile-admin.php');


function lastfm_profile_scripts() {
	wp_register_script('handlebars_js', plugin_dir_url(__FILE__) . 'js/handlebars.js');
	wp_enqueue_script('handlebars_js');
	wp_register_script('lastfm_profile_script', plugin_dir_url(__FILE__) . 'js/lastfm-profile.js');
	wp_enqueue_script('lastfm_profile_script');
}

add_action('wp_enqueue_scripts', 'lastfm_profile_scripts');

function lastfm_profile_display() {
	?>
	<script id="lastfm-profile-handlebars" type="text/x-handlebars-template">
		<ul>
			{{#each artists}}
				<li>
					<img src="{{image.[0].[#text]}}" alt="{{name}}" />
					<h4>{{name}}</h4>
				</li>
			{{/each}}
		</ul>
	</script>
	<div id="lastfm_profile"></div>
	<?php
}
?>