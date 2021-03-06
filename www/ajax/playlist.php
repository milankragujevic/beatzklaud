<?php
error_reporting(0);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
header('Content-Type: application/json; charset=utf-8');

$pfile = __DIR__ . '/playlist.json';

if(isset($_GET['action']) && $_GET['action'] == 'add') {
	$id = $_GET['id'];
	$playlist = json_decode(file_get_contents($pfile), true);
	if(in_array($id, $playlist)) { echo json_encode(array('error' => true)); exit; }
	$playlist[] = $id;
	file_put_contents($pfile, json_encode($playlist));
	echo json_encode(array('success' => true));
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'delete') {
	$id = $_GET['id'];
	$playlist = json_decode(file_get_contents($pfile), true);
	$key = $key = array_search($id, $playlist);
	if($key !== false) {
		unset($playlist[$key]);
	} else {
		echo json_encode(array('error' => true)); exit;
	}
	file_put_contents($pfile, json_encode($playlist));
	echo json_encode(array('success' => true));
	exit;
}

echo json_encode(array_values(json_decode(file_get_contents($pfile), true)));