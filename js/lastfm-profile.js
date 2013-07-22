
var lastfmProfile = function() {
	var lastfmProfileDiv = $('#lastfm_profile');
	var artistDisplayCount;

	var init = function(artistDisplayCount) {
		this.artistDisplayCount = artistDisplayCount;

		getTopArtists();
	}

	var getTopArtists = function() {
		jQuery.ajax({
			url: 'http://ws.audioscrobbler.com/2.0/?method=user.gettopartists&user=pablious&api_key=0c48e23cbb8d3bc9e2268146c1f520d7&format=json&limit=' + artistDisplayCount
		}).done(function(data) {
			var artistList = $('<ul>');

			if (!data.error) {
				foreach (var artist in data.topartists.artist) {
					var artistItem = $('<li>');
					artistList.append($('<img>', 'src': artist.image['small']['#text']
				}
			}
		});
	}

	return {
		init: init
	}
}();

lastfmProfile.init();