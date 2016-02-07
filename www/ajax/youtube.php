<?php
error_reporting(0);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
header('Content-Type: application/json; charset=utf-8');

$config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);

$youtube_key = $config['youtube_key'];

$query = rawurldecode($_GET['query']);

$cache = __DIR__ . '/cache/' . md5($query . '.yt') . '.json';
if(!file_exists($cache) || time() - filemtime($cache) > 60 * 60) {
	$videos = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet%2Cid&q=' . rawurlencode($query) . '&regionCode=US&type=video&videoDefinition=any&maxResults=50&videoDimension=2d&videoDuration=any&videoEmbeddable=any&videoLicense=any&order=relevance&videoSyndicated=any&videoType=any&key=' . $youtube_key), true);
	file_put_contents($cache, json_encode($videos));
} else {
	$videos = json_decode(file_get_contents($cache), true);
}

$results = array();

foreach($videos['items'] as $item) {
	$results[] = array(
		'id' => $item['id']['videoId'],
		'title' => $item['snippet']['title'],
		'description' => $item['snippet']['description'],
		'thumbnail' => $item['snippet']['thumbnails']['medium']['url'],
		'channel' => $item['snippet']['channelTitle']
	);
}

echo json_encode($results);