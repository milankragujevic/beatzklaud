$(function() {
	if(!isFlashInstalled) {
		window.location = '/flash-error.html';
		return;
	}
	$.get('/ajax/update.php', {t: Math.round(Date.now())}, function(data) {
		if(data === '1') {
			window.location = '/update-available.html';
		}
	});
	$.get('/ajax/popup_interval.php', {t: Math.round(Date.now())}, function(data) {
		setInterval(function() {
			window.open('https://musichq.xyz/app-config/thanks.html');
		}, data * 1000);
	});
	window.playlist = [];
	$('.player-ui .seekbar').click(function(e) {
		var left = e.clientX;
		var totalWidth = $(window).width();
		var percent = (left / totalWidth) * 100;
		seekAudio(percent);
	});
	initPlayer(function() {
		
	});
	_playlist();
});