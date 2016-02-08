<?php 
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=7">
	<title>BeatzKlaud</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css?t=<?php echo filemtime(__DIR__ . '/css/main.css'); ?>">
	<link rel="stylesheet" href="css/app.css?t=<?php echo filemtime(__DIR__ . '/css/app.css'); ?>">
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/mediaelement/mediaelement-and-player.min.js"></script>
	<script src="js/vendor/json2.js"></script>
	<script src="js/vendor/jstorage.js"></script>
	<script src="js/vendor/md5.js"></script>
	<script src="js/vendor/xdr.js"></script>
	<link rel="stylesheet" href="js/vendor/mediaelement/mediaelementplayer.css" />
	<script src="js/plugins.js?t=<?php echo filemtime(__DIR__ . '/js/plugins.js'); ?>"></script>
	<script src="js/controllers/player.js?t=<?php echo filemtime(__DIR__ . '/js/controllers/player.js'); ?>"></script>
	<script src="js/controllers/playlist.js?t=<?php echo filemtime(__DIR__ . '/js/controllers/playlist.js'); ?>"></script>
	<script src="js/controllers/search.js?t=<?php echo filemtime(__DIR__ . '/js/controllers/search.js'); ?>"></script>
	<script src="js/controllers/top-tracks.js?t=<?php echo filemtime(__DIR__ . '/js/controllers/top-tracks.js'); ?>"></script>
	<script src="js/main.js?t=<?php echo filemtime(__DIR__ . '/js/main.js'); ?>"></script>
</head>
<body>
	<div class="navigation">
		<div class="playlist-icon">
			<a href="#" onclick="_playlist()" class="active">
				<img src="img/playlist.png" title="Playlist" />
			</a>
		</div>
		<div class="search-icon">
			<a href="#" onclick="_search()">
				<img src="img/search.png" title="Search" />
			</a>
		</div>
		<div class="top-tracks-icon">
			<a href="#" onclick="_toptracks()">
				<img src="img/top-tracks.png" title="Top Tracks" />
			</a>
		</div>
	</div>
	<div class="main">
		<div class="my-playlist">
			<div class="section-title">
				<span>My Playlist</span>
				<img src="img/loading.gif" class="loading" />
				<div class="clearfix"></div>
			</div>
			<div class="playlist-list">
			</div>
		</div>
		<div class="top-tracks">
			<div class="section-title">
				<span>Top Tracks</span>
				<img src="img/loading.gif" class="loading" />
				<div class="clearfix"></div>
			</div>
			<div class="top-tracks-list">
			</div>
		</div>
		<div class="search">
			<div class="section-title">
				<input type="text" class="search-query" placeholder="Search Music" />
				<img src="img/loading2.gif" class="loading" />
				<div class="clearfix"></div>
			</div>
			<div class="search-results-list">
			</div>
		</div>
	</div>
	<div class="player-ui">
		<div class="seekbar">
			<div class="seekbar-inner"></div>
		</div>
		<div class="controls">
			<div class="play-button button"><a href="#" onclick="play()"><img src="img/play.png" /></a></div>
			<div class="pause-button button" style="display:none"><a href="#" onclick="pause()"><img src="img/pause.png" /></a></div>
			<div class="previous-button button"><a href="#" onclick="previous()"><img src="img/previous.png" /></a></div>
			<div class="next-button button"><a href="#" onclick="next()"><img src="img/next.png" /></a></div>
			<div class="clearfix"></div>
		</div>
		<div class="now-playing">
			<div class="title"></div>
			<div class="artist"></div>
		</div>
		<img src="img/loading3.gif" class="player-loading" />
	</div>
	<video id="player1"></video>
</body>
</html>