<?php
set_time_limit(0);

$id = substr($_GET['id'], 0, 12);
if($id == '') { exit; }

foreach(glob(__DIR__ . '/*.json') as $cf) {
	if(time() - filemtime($cf) > 60 * 60) {
		unlink($cf);
	}
}

if(time - filemtime(__DIR__ . '/youtube-dl.exe') > 60 * 60 * 24 * 3) {
	file_put_contents(__DIR__ . '/youtube-dl.exe', file_get_contents('https://yt-dl.org/latest/youtube-dl.exe'));
}

if(!file_exists(__DIR__ . '/' . $id . '.info.json')) {
	$command = 'youtube-dl "https://www.youtube.com/watch?v=' . $id . '" --no-color --write-info-json --skip-download  -o "' . $id . '"';
	exec($command);
}

$api = json_decode(file_get_contents(__DIR__ . '/' . $id . '.info.json'), true);

header('Content-Type: text/plain; charset=utf-8');

$stream = '';
foreach($api['formats'] as $format) { if($format['format_id'] == '18') { $stream = $format['url']; } }

if($stream == '') { exit; }

echo $stream;