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
 * Register css and scripts including Handlebars.js and the plugin script
 */
function lastfm_profile_scripts() {
	wp_register_script('handlebars_js', plugin_dir_url(__FILE__) . 'js/handlebars.js');
	wp_enqueue_script('handlebars_js');
	wp_register_script('lastfm_profile_script', plugin_dir_url(__FILE__) . 'js/lastfm-profile.js', array('jquery'));
	wp_enqueue_script('lastfm_profile_script');
	wp_register_style('lastfm_profile_style', plugin_dir_url(__FILE__) . 'css/lastfm-profile.css');
	wp_enqueue_style('lastfm_profile_style');
}

add_action('wp_enqueue_scripts', 'lastfm_profile_scripts');


/**
 * Insert this method into a template to return base plugin html.
 * Includes a Handlebars.js template which will render json of artists returned by Last.fm.
 */
function lastfm_profile_display() {
	?>
	<script id="lastfm-profile-artists-handlebars" type="text/x-handlebars-template">
		{{#if data.error}}
			<h4>An error has occurred retrieving Last.fm data</h4>
		{{else}}
			<ul class="lastfm-profile-section-list">
				{{#each data.topartists.artist}}
					<li>
						<a href="{{url}}">
							<h4>{{[@attr].rank}}. {{name}}</h4>
							<img src="{{image.[0].[#text]}}" alt="{{name}}" />
							Plays: {{playcount}}
						</a>
					</li>
				{{/each}}
			</ul>
		{{/if}}
	</script>
	<ul id="lastfm-profile">
		<li id="lastfm-profile-header"></li>
		<li id="lastfm-profile-artists" class="lastfm-profile-section">
			<h2>My Top Artists</h2>
		</li>
	</ul>
	<?php
}
?>