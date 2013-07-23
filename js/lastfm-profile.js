
var lastfmProfile = function() {
	// Initialize local variables
	var $,
		lastfmProfileContent,
		lastfmProfileArtists, 
		username,
		artistDisplayCount, 
		artistsSource, 
		artistsTemplate, 
		handlebarsContext, 
		handlebarsHtml;

	$ = jQuery;

	// Init function for lastfmProfile plugin js
	var init = function(_username, _artistDisplayCount) {
		// Set local variables
		lastfmProfileContent = $('#lastfm-profile');
		lastfmProfileArtists = $('#lastfm-profile-artists');
		username = _username;
		artistDisplayCount = _artistDisplayCount;

		// Set handlebars variables
		artistsSource = $('#lastfm-profile-artists-handlebars').html();
		artistsTemplate = Handlebars.compile(artistsSource);

		getTopArtists();
	}

	// 
	var getTopArtists = function() {
		$.ajax({
			url: 'http://ws.audioscrobbler.com/2.0/',
			data: {
				method: 'user.gettopartists',
				user: username,
				api_key: '0c48e23cbb8d3bc9e2268146c1f520d7',
				format: 'json',
				limit: artistDisplayCount
			}
		}).done(function(data) {
			handlebarsContext = { data: data };
			handlebarsHtml = artistsTemplate(handlebarsContext);
			lastfmProfileArtists.append(handlebarsHtml);
		});
	}

	return {
		init: init
	}
}();

jQuery(function() {
	lastfmProfile.init(settings.username, settings.artistDisplayCount);
});
