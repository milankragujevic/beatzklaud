function next() {
	
}

function previous() {
	
}

function play() {
	if(window.player_state == 'paused') {
		window.player_state = 'playing';
		window.player.play();
		hidePlay();
		showPause();
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
	window.player.setSrc(url);
	play();
}

function initPlayer(callback) {
	new MediaElement('player1', {
		enablePluginDebug: false,
		plugins: ['flash', 'silverlight'],
		type: 'audio/mp3',
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
			window.player_state = 'paused';
			mediaElement.addEventListener('timeupdate', function(e) { 
				updatePlayerTime();
			}, false);
			callback();
		},
		error: function () {}
	});
}