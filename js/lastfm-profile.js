
var lastfmProfile = function() {
	$ = jQuery;
	var lastfmProfileDiv, 
		artistDisplayCount, 
		handlebarsSource, 
		handlebarsTemplate, 
		handlebarsContext, 
		handlebarsHtml;

	var init = function(_artistDisplayCount) {
		lastfmProfileDiv = $('#lastfm_profile');
		artistDisplayCount = _artistDisplayCount;
		handlebarsSource = $('#lastfm-profile-handlebars').html();
		handlebarsTemplate = Handlebars.compile(handlebarsSource);

		getTopArtists();
	}

	var getTopArtists = function() {
		$.ajax({
			url: 'http://ws.audioscrobbler.com/2.0/?method=user.gettopartists&user=pablious&api_key=0c48e23cbb8d3bc9e2268146c1f520d7&format=json&limit=' + artistDisplayCount
		}).done(function(data) {
			handlebarsContext = { artists: data.topartists.artist };
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
