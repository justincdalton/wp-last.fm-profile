
var lastfmProfile = function() {
	// Initialize local variables
	var $,
		lastfmProfileDiv, 
		artistDisplayCount, 
		handlebarsSource, 
		handlebarsTemplate, 
		handlebarsContext, 
		handlebarsHtml;

	$ = jQuery;

	// Init function for lastfmProfile plugin js
	var init = function(_artistDisplayCount) {
		// Set local variables
		lastfmProfileDiv = $('#lastfm_profile');
		artistDisplayCount = _artistDisplayCount;

		// Set handlebars variables
		handlebarsSource = $('#lastfm-profile-artists-handlebars').html();
		handlebarsTemplate = Handlebars.compile(handlebarsSource);

		getTopArtists();
	}

	// 
	var getTopArtists = function() {
		$.ajax({
			url: 'http://ws.audioscrobbler.com/2.0/?method=user.gettopartists&user=pablious&api_key=0c48e23cbb8d3bc9e2268146c1f520d7&format=json&limit=' + artistDisplayCount
		}).done(function(data) {
			handlebarsContext = { data: data };
			handlebarsHtml = handlebarsTemplate(handlebarsContext);
			lastfmProfileDiv.append(handlebarsHtml);
		});
	}

	return {
		init: init
	}
}();

jQuery(function() {
	lastfmProfile.init(12);
});
