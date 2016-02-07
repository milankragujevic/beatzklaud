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

$id = $_GET['id'];

$ids = json_decode(file_get_contents(__DIR__ . '/ids.json'), true);

if(!isset($track_cache[$id])) {
	if(!isset($ids[$id])) { echo json_encode(array('error' => true)); exit; }
	list($artist, $title) = explode(' - ', $ids[$id]);
	$tracks = json_decode(file_get_contents('https://ws.audioscrobbler.com/2.0/?method=track.search&format=json&limit=30&page=1&api_key=' . $lastfm_key . '&track=' . rawurlencode($artist . ' - ' . $title)), true);
	$track_cache[$id] = array(
		'id' => $id,
		'title' => $tracks['results']['trackmatches']['track'][0]['name'],
		'artist' => $tracks['results']['trackmatches']['track'][0]['artist'],
		'thumbnail' => $tracks['results']['trackmatches']['track'][0]['image'][2]['#text'] ?: '/ajax/default.jpg'
	);
	file_put_contents(__DIR__ . '/tracks-cache.json', json_encode($track_cache));
}

echo json_encode($track_cache[$id]);