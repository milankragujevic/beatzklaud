function _search() { 
	$('.my-playlist').hide();
	$('.search').show();
	$('.playlist-icon a').removeClass('active');
	$('.search-icon a').addClass('active');
	$('.search input').focus();
	$('.search input').on('keydown', function(e) {
		if(e.keyCode == 13) {
			$('.loading').show();
			$.get(api + 'search?query=' + encodeURIComponent($('.search input').val()), function(data) {
				$('.search-results-list').html('');
				$('.loading').hide();
                $.each(data.results, function(i, track) {
                    var id = sha1sum(track.artist + ' - ' + track.title);
                    $('.search-results-list').append('<div class="track" data-id="' + id + '"><div class="cover"><img src="' + track.thumbnail + '" width="87" height="87" /></div><div class="info"><div class="title">' + track.title + '</div><div class="meta">by <span class="artist">' + track.artist + '</span></div></div></div>');
                });
			});
		}
	});
}