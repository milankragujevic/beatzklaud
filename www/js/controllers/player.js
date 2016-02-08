function next() {
	if(total_songs() < 2) { return; }
	var song = current_song() + 1;
	if(song > total_songs()) {
		song = 0;
	}
	window.current_index = song;
	play_song(get_nth_song(song));
}

function previous() {
	if(total_songs() < 2) { return; }
	var song = current_song() - 1;
	if(song < 0) {
		song = total_songs() - 1;
	}
	window.current_index = song;
	play_song(get_nth_song(song));
}

function play() {
	if(window.player_state == 'paused') {
		window.player_state = 'playing';
		window.player.play();
		hidePlay();
		showPause();
	} else {
		window.current_index = 0;
		window.player_state = 'paused';
		play_song(get_nth_song(0));
	}
}

function pause() {
	if(window.player_state == 'playing') {
		window.player_state = 'paused';
		window.player.pause();
		hidePause();
		showPlay();
	}
}

function hidePause() {
	$('.controls .pause-button').hide();
}

function showPause() {
	$('.controls .pause-button').show();
}

function hidePlay() {
	$('.controls .play-button').hide();
}

function showPlay() {
	$('.controls .play-button').show();
}

function updateSeekbar(percent) {
	$('.player-ui .seekbar .seekbar-inner').css('left', percent + '%');
}

function seekAudio(percent) {
	var duration = parseInt(window.player.duration);
	var time = Math.round((duration * percent) / 100);
	window.player.setCurrentTime(time);
	updateSeekbar(percent);
}

function updatePlayerTime() {
	var currentTime = parseInt(window.player.currentTime);
	var duration = parseInt(window.player.duration);
	var percent = (currentTime / duration) * 100;
	updateSeekbar(percent);
}

function playURL(url) {
	window.player_state = 'paused';
	window.player.setSrc(url);
	window.player.setCurrentTime(0);
	updateSeekbar(0);
	play();
}

function initPlayer(callback) {
	new MediaElement('player1', {
		enablePluginDebug: false,
		plugins: ['flash', 'silverlight'],
		type: 'video/mp4',
		pluginPath: '/js/vendor/mediaelement/',
		flashName: 'flashmediaelement.swf',
		silverlightName: 'silverlightmediaelement.xap',
		defaultVideoWidth: 0,  
		defaultVideoHeight: 0,
		pluginWidth: 0,    
		pluginHeight: 0,
		timerRate: 250,
		success: function (mediaElement, domObject) { 
			window.player = mediaElement;
			window.player_state = 'stopped';
			mediaElement.addEventListener('timeupdate', function(e) { 
				updatePlayerTime();
			}, false);
			mediaElement.addEventListener('ended', function(e) { 
				if(window.player.duration > 0 && window.player_state != 'paused') {
					next();
				}
			}, false);
			callback();
		},
		error: function () {}
	});
}