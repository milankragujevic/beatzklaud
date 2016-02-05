$(function() {
	window.api = 'https://api.musichq.xyz/';
	$('.player-ui .seekbar').click(function(e) {
		var left = e.clientX;
		var totalWidth = $(window).width();
		var percent = (left / totalWidth) * 100;
		seekAudio(percent);
	});
	initPlayer(function() {
		playURL('http://localhost/leanon.mp3');
	});
	_playlist();
});