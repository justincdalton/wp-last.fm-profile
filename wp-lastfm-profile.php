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


/**
 * Register scripts including Handlebars.js and the plugin script
 */
function lastfm_profile_scripts() {
	wp_register_script('handlebars_js', plugin_dir_url(__FILE__) . 'js/handlebars.js');
	wp_enqueue_script('handlebars_js');
	wp_register_script('lastfm_profile_script', plugin_dir_url(__FILE__) . 'js/lastfm-profile.js');
	wp_enqueue_script('lastfm_profile_script');
}

add_action('wp_enqueue_scripts', 'lastfm_profile_scripts');


/**
 * Insert this method into a template to return base plugin html.
 * Includes a Handlebars.js template which will render json of artists returned by Last.fm.
 */
function lastfm_profile_display() {
	?>
	<script id="lastfm-profile-handlebars" type="text/x-handlebars-template">
		{{#if data.error}}
			<h4>An error has occurred retrieving Last.fm data</h4>
		{{else}}
			<ul>
				{{#each data.topartists.artist}}
					<li>
						<img src="{{image.[0].[#text]}}" alt="{{name}}" />
						<h4>{{name}}</h4>
					</li>
				{{/each}}
			</ul>
		{{/if}}
	</script>
	<div id="lastfm_profile"></div>
	<?php
}
?>