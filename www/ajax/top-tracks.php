<?php
error_reporting(0);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
header('Content-Type: application/json; charset=utf-8');

$track_cache = json_decode(file_get_contents(__DIR__ . '/tracks-cache.json'), true);
$config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);

$lastfm_key = $config['lastfm_key'];

$cache = __DIR__ . '/cache/' . md5('top-tracks') . '.json';
if(!file_exists($cache) || time() - filemtime($cache) > 60 * 60) {
	$tracks = json_decode(file_get_contents('https://ws.audioscrobbler.com/2.0/?method=chart.getTopTracks&format=json&limit=30&page=1&api_key=' . $lastfm_key), true);
	file_put_contents($cache, json_encode($tracks));
} else {
	$tracks = json_decode(file_get_contents($cache), true);
}

$results = array();

foreach($tracks['tracks']['track'] as $_t) {
	$id = md5($_t['artist'] . ' - ' . $_t['name']);
	$ids = json_decode(file_get_contents(__DIR__ . '/ids.json'), true);
	$ids[$id] = $_t['artist']['name'] . ' - ' . $_t['name'];
	file_put_contents(__DIR__ . '/ids.json', json_encode($ids));
	$results[] = array(
		'id' => $id,
		'title' => $_t['name'],
		'artist' => $_t['artist']['name'],
		'thumbnail' => $_t['image'][2]['#text'] ?: '/ajax/default.jpg'
	);
}

echo json_encode($results);