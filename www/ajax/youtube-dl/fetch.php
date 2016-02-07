<?php
set_time_limit(0);

$id = substr($_GET['id'], 0, 12);
if($id == '') { exit; }

if(!file_exists(__DIR__ . '/' . $id . '.info.json') || time() - filemtime(__DIR__ . '/' . $id . '.info.json') > 60 * 60) {
	$command = 'youtube-dl "https://www.youtube.com/watch?v=' . $id . '" --no-color --write-info-json --skip-download  -o "' . $id . '"';
	exec($command);
}

$api = json_decode(file_get_contents(__DIR__ . '/' . $id . '.info.json'), true);

header('Content-Type: text/plain; charset=utf-8');

$stream = '';
foreach($api['formats'] as $format) { if($format['format_id'] == '18') { $stream = $format['url']; } }

if($stream == '') { exit; }

echo $stream;