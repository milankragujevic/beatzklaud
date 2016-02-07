function _search() { 
	$('.my-playlist').hide();
	$('.top-tracks').hide();
	$('.search').show();
	$('.playlist-icon a').removeClass('active');
	$('.top-tracks-icon a').removeClass('active');
	$('.search-icon a').addClass('active');
	$('body').addClass('is-search');
	$('.search input').focus();
	$('.search input').on('keydown', function(e) {
		if(e.keyCode == 13) {
			$('.loading').show();
			$.get('/ajax/search.php', {query: $('.search input').val(), t: Math.round(Date.now())}, function(data) {
				$('.search-results-list').html('');
				$('.loading').hide();
                $.each(data, function(i, track) {
                    $('.search-results-list').append('<div class="track" data-id="' + track.id + '"><div class="cover"><img src="' + track.thumbnail + '" width="87" height="87" /></div><div class="info"><div class="title">' + track.title + '</div><div class="meta">by <span class="artist">' + track.artist + '</span></div></div><div class="actions"><a href="#" class="add-to-playlist"><img src="img/add2.png" /></a><a href="#" class="play-song"><img src="img/play2.png" /></a></div></div>');
                });
			});
		}
	});
	$('.search-results-list').on('click', '.track .add-to-playlist', function() {
		var id = $(this).parent().parent().attr('data-id');
		add_song_to_playlist(id);
	});
	$('.search-results-list').on('click', '.track .play-song', function() {
		var id = $(this).parent().parent().attr('data-id');
		window.current_index = -1;
		play_song(id);
	});
}