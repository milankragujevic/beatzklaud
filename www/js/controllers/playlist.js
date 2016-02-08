function get_first_playlist_item() {
	var i = -1;
	while(true) {
		i++;
		if(typeof window.playlist[i] != 'undefined') {
			return i;
		}
	}
}

function get_next_playlist_item() {
	var i = window.current_index;
	while(true) {
		if(i > total_songs()) { return total_songs(); }
		i++;
		if(typeof window.playlist[i] != 'undefined') {
			return i;
		}
	}
}

function get_prev_playlist_item() {
	var i = window.current_index;
	while(true) {
		if(i < 0 ) { return -1; }
		i--;
		if(typeof window.playlist[i] != 'undefined') {
			return i;
		}
	}
}

function next_track_pusher(i) {
	if(typeof window.playlist[i + 1] != 'undefined') {
		push_track_playlist(i + 1);
	}
}

function push_track_playlist(i) {
	var id = window.playlist[i];
	$.get('/ajax/track.php', {id: id, t: Math.round(Date.now())}, function(track) {
		$('.playlist-list .track[data-id="' + id + '"]').remove();
		$('.playlist-list').append('<div class="track" data-i="' + i + '" data-id="' + id + '"><div class="cover"><img src="' + track.thumbnail + '" width="87" height="87" /></div><div class="info"><div class="title">' + track.title + '</div><div class="meta">by <span class="artist">' + track.artist + '</span></div></div><div class="actions"><a href="#" class="delete-from-playlist"><img src="img/delete2.png" /></a><a href="#" class="play-song"><img src="img/play2.png" /></a></div></div>');
		next_track_pusher(i);
	});
}

function redraw_tracks() {
	$('.loading').fadeIn(300);
	$.get('/ajax/playlist.php', {t: Math.round(Date.now())}, function(data) {
		$('.playlist-list').html('');
		if(data == null) { data = []; }
		window.playlist = data;
		push_track_playlist(get_first_playlist_item());
		$('.loading').fadeOut(300);
	});
}

function add_song_to_playlist(id) {
	$.get('/ajax/playlist.php', {action: 'add', id: id, t: Math.round(Date.now())}, function(data) {
		redraw_tracks();
	});
}

function delete_song_from_playlist(id) {
	$.get('/ajax/playlist.php', {action: 'delete', id: id, t: Math.round(Date.now())}, function(data) {
		redraw_tracks();
	});
}

function play_song(id, hidePrevNext) {
	if(id == '') { return; }
	if(hidePrevNext) {
		$('.controls .next-button').hide();
		$('.controls .previous-button').hide();
		$('.now-playing').addClass('no-n2d');
	} else {
		$('.controls .next-button').show();
		$('.controls .previous-button').show();
		$('.now-playing').removeClass('no-n2d');
	}
	$('.player-loading').fadeIn(300);
	$.get('/ajax/track.php', {id: id, t: Math.round(Date.now())}, function(track) {
		$('.now-playing .title').html(track.title);
		$('.now-playing .artist').html(track.artist);
		$.get('/ajax/youtube.php', {query: track.artist + ' - ' + track.title, t: Math.round(Date.now())}, function(data) {
			var videoId = data[0].id;
			$.get('/ajax/youtube-dl/fetch.php', {id: videoId, t: Math.round(Date.now())}, function(data) {
				if(data == '') { return; }
				playURL(data);
				$('.player-loading').fadeOut(300);
			});
		});
	});
}

function get_nth_song(n) {
	if(typeof window.playlist == 'undefined') {
		return '';
	}
	if(typeof window.playlist[n] != 'undefined' && window.playlist[n].length > 0) {
		return window.playlist[n];
	} else {
		return '';
	}
}

function total_songs() {
	if(typeof window.playlist == 'undefined') {
		return 0;
	}
	var myArray = $.map(window.playlist, function(v) { return v; });
	return myArray.length;
}

function current_song() {
	return window.current_index;
}

function _playlist() {
	$('.search').hide();
	$('.top-tracks').hide();
	$('.my-playlist').show();
	$('body').removeClass('is-search');
	$('.search-icon a').removeClass('active');
	$('.top-tracks-icon a').removeClass('active');
	$('.playlist-icon a').addClass('active');
	redraw_tracks();
	$('.playlist-list').on('click', '.track .delete-from-playlist', function() {
		var id = $(this).parent().parent().attr('data-id');
		delete_song_from_playlist(id);
	});
	$('.playlist-list').on('click', '.track .play-song', function() {
		var id = $(this).parent().parent().attr('data-id');
		var i = $(this).parent().parent().attr('data-i');
		window.current_index = i;
		play_song(id);
	});
}