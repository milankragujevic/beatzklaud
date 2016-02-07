$(function() {
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