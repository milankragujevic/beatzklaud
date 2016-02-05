function _playlist() {
	$('.search').hide();
	$('.my-playlist').show();
	$('.search-icon a').removeClass('active');
	$('.playlist-icon a').addClass('active');
	//redraw_tracks();
}